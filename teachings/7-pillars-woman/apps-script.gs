/**
 * StayTheWay Ministry — Prayer Request Backend (Google Apps Script)
 * ================================================================
 * Purpose:
 *   - Receives prayer request submissions from prayer.html
 *   - Rejects spam (honeypot + timing checked client-side; server adds rate-limit)
 *   - Sends a one-click verification email to the requester
 *   - On verify: saves prayer to "Prayers" sheet, adds to "Email List" sheet if opted in
 *
 * SETUP (do this once):
 *   1. Create a Google Sheet called "StayTheWay Prayer + Email List"
 *      Add two tabs named exactly:  Prayers   and   Email List
 *      (The script will auto-create header rows on first write.)
 *   2. Go to Extensions → Apps Script.
 *   3. Paste this entire file. Save.
 *   4. Update CONFIG below (SHEET_ID, FROM_NAME, NOTIFY_EMAILS).
 *   5. Deploy → New deployment → type: Web app
 *      - Execute as: Me
 *      - Who has access: Anyone
 *      - Copy the Web app URL.
 *   6. Paste that URL into prayer.html (APPS_SCRIPT_URL constant).
 *   7. To rotate for next week's teaching, just re-run the same deployment —
 *      the script handles any topic via the "topic" field in the POST body.
 *
 * SECURITY NOTES:
 *   - Double opt-in: prayer is NOT saved until the user clicks the email link.
 *   - Pending entries expire after 48 hours (cleaned by the cron trigger — optional).
 *   - All responses are JSON. CORS is open (Apps Script web apps handle this automatically).
 */

// ============ CONFIG ============
const CONFIG = {
  SHEET_ID: "REPLACE_WITH_YOUR_GOOGLE_SHEET_ID",
  FROM_NAME: "StayTheWay Ministry",
  SUBJECT_VERIFY: "Confirm your prayer request — StayTheWay Ministry",
  NOTIFY_EMAILS: ["prayer@staytheway.com"], // who to notify when a verified prayer arrives
  VERIFY_TTL_HOURS: 48,
};

// ============ Endpoints ============

// POST handler — receives JSON body from the form
function doPost(e) {
  try {
    const data = JSON.parse(e.postData.contents || "{}");
    const { name, email, request, optin, topic, submittedAt } = data;

    // Basic validation
    if (!name || !email || !request) {
      return jsonResponse({ status: "error", message: "Missing required fields." }, 400);
    }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      return jsonResponse({ status: "error", message: "Invalid email address." }, 400);
    }
    if (String(request).length < 10 || String(request).length > 2000) {
      return jsonResponse({ status: "error", message: "Prayer request length is out of range." }, 400);
    }

    // Rate-limit: max 3 pending from the same email
    const pending = getPendingSheet();
    const pendingEmails = pending.getRange(2, 2, Math.max(1, pending.getLastRow() - 1), 1).getValues().flat();
    const pendingCount = pendingEmails.filter(e => String(e).toLowerCase() === email.toLowerCase()).length;
    if (pendingCount >= 3) {
      return jsonResponse({ status: "error", message: "Too many pending requests for this email. Please check your inbox." }, 429);
    }

    // Create verification token and store pending row
    const token = generateToken();
    const webAppUrl = ScriptApp.getService().getUrl();
    const verifyUrl = `${webAppUrl}?token=${encodeURIComponent(token)}`;
    pending.appendRow([
      new Date(), // 1 createdAt
      email,      // 2
      name,       // 3
      request,    // 4
      optin ? "yes" : "no", // 5
      topic || "", // 6
      token,      // 7
      submittedAt || "" // 8
    ]);

    // Send verification email
    const body =
      `Hi ${name},\n\n` +
      `We received your prayer request through StayTheWay Ministry. ` +
      `To protect the prayer inbox from spam, please confirm it was you by clicking the link below:\n\n` +
      `${verifyUrl}\n\n` +
      `Once you click, your request goes to our prayer team and we'll carry it before the Father.\n\n` +
      `If you did not submit this, ignore this email — nothing will be saved.\n\n` +
      `Grace and peace,\n` +
      `${CONFIG.FROM_NAME}`;

    MailApp.sendEmail({
      to: email,
      subject: CONFIG.SUBJECT_VERIFY,
      body: body,
      name: CONFIG.FROM_NAME,
      replyTo: CONFIG.NOTIFY_EMAILS[0]
    });

    return jsonResponse({ status: "pending", message: "Verification email sent." });
  } catch (err) {
    return jsonResponse({ status: "error", message: "Server error: " + err.message }, 500);
  }
}

// GET handler — handles the verification click
function doGet(e) {
  const token = e.parameter.token;
  if (!token) {
    return htmlPage("Invalid link",
      "<p>This verification link is missing its token. Please submit your prayer request again.</p>");
  }

  const pending = getPendingSheet();
  const rows = pending.getDataRange().getValues();
  let foundRow = -1;
  for (let i = 1; i < rows.length; i++) {
    if (rows[i][6] === token) { foundRow = i; break; }
  }
  if (foundRow === -1) {
    return htmlPage("Link already used or expired",
      "<p>This link has already been used or has expired. If you still need prayer, please submit again at " +
      "<a href='https://staytheway.com'>staytheway.com</a>.</p>");
  }

  const [createdAt, email, name, request, optin, topic, _token] = rows[foundRow];

  // TTL check
  const ageHours = (Date.now() - new Date(createdAt).getTime()) / 3600000;
  if (ageHours > CONFIG.VERIFY_TTL_HOURS) {
    pending.deleteRow(foundRow + 1);
    return htmlPage("Link expired",
      "<p>This verification link expired after " + CONFIG.VERIFY_TTL_HOURS +
      " hours. Please submit your prayer request again.</p>");
  }

  // Move to verified Prayers sheet
  const prayers = getPrayersSheet();
  prayers.appendRow([new Date(), name, email, request, topic, "verified"]);

  // Add to email list if opted in
  if (String(optin).toLowerCase() === "yes") {
    const list = getEmailListSheet();
    const existing = list.getRange(2, 2, Math.max(1, list.getLastRow() - 1), 1).getValues().flat();
    if (!existing.some(e => String(e).toLowerCase() === String(email).toLowerCase())) {
      list.appendRow([new Date(), email, name, topic, "verified"]);
    }
  }

  // Notify prayer team
  try {
    const notify =
      `A new prayer request has been verified.\n\n` +
      `From: ${name} <${email}>\n` +
      `Topic: ${topic}\n\n` +
      `Request:\n${request}\n`;
    MailApp.sendEmail({
      to: CONFIG.NOTIFY_EMAILS.join(","),
      subject: "New prayer request — " + (topic || "StayTheWay"),
      body: notify,
      name: CONFIG.FROM_NAME
    });
  } catch (_) {}

  // Remove from Pending
  pending.deleteRow(foundRow + 1);

  return htmlPage("Thank you — your prayer is with us",
    "<p>Thank you, <strong>" + escapeHtml(name) + "</strong>. Your prayer request has been verified and sent to our prayer team.</p>" +
    "<p>&ldquo;Cast all your care upon Him, for He cares for you.&rdquo; — 1 Peter 5:7</p>" +
    (String(optin).toLowerCase() === "yes"
      ? "<p>You're also added to our email list. You can unsubscribe any time by replying to any email.</p>"
      : "") +
    "<p><a href='https://staytheway.com'>← back to staytheway.com</a></p>");
}

// ============ Helpers ============

function getSheetTab(name) {
  const ss = SpreadsheetApp.openById(CONFIG.SHEET_ID);
  let sheet = ss.getSheetByName(name);
  if (!sheet) sheet = ss.insertSheet(name);
  return sheet;
}
function getPendingSheet() {
  const s = getSheetTab("Pending");
  if (s.getLastRow() === 0) {
    s.appendRow(["createdAt","email","name","request","optin","topic","token","submittedAtClient"]);
  }
  return s;
}
function getPrayersSheet() {
  const s = getSheetTab("Prayers");
  if (s.getLastRow() === 0) {
    s.appendRow(["verifiedAt","name","email","request","topic","status"]);
  }
  return s;
}
function getEmailListSheet() {
  const s = getSheetTab("Email List");
  if (s.getLastRow() === 0) {
    s.appendRow(["addedAt","email","name","source_topic","status"]);
  }
  return s;
}

function generateToken() {
  return Utilities.getUuid().replace(/-/g, "") + Utilities.getUuid().replace(/-/g, "").slice(0, 8);
}

function jsonResponse(obj, status) {
  const output = ContentService.createTextOutput(JSON.stringify(obj));
  output.setMimeType(ContentService.MimeType.JSON);
  return output;
}

function htmlPage(title, bodyHtml) {
  const html =
    `<!doctype html><html><head><meta charset="utf-8"/><title>${escapeHtml(title)} — StayTheWay</title>` +
    `<meta name="viewport" content="width=device-width, initial-scale=1.0"/>` +
    `<style>body{background:#000014;color:#DCDCDC;font-family:Georgia,serif;padding:2rem 1rem;max-width:640px;margin:0 auto;line-height:1.6;}` +
    `h1{color:#FFF;font-size:1.7rem;border-bottom:3px solid #1478F0;padding-bottom:.5rem;}` +
    `a{color:#28A0F0;}strong{color:#FFF;}</style></head><body>` +
    `<h1>${escapeHtml(title)}</h1>${bodyHtml}</body></html>`;
  return HtmlService.createHtmlOutput(html);
}

function escapeHtml(s) {
  return String(s).replace(/[&<>"']/g, c =>
    ({ "&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#39;" }[c]));
}

// ============ OPTIONAL: daily cleanup trigger ============
// To auto-expire old pending entries, add a Time-driven trigger for this function (daily):
function cleanupExpiredPending() {
  const pending = getPendingSheet();
  const rows = pending.getDataRange().getValues();
  const now = Date.now();
  for (let i = rows.length - 1; i >= 1; i--) {
    const ageHours = (now - new Date(rows[i][0]).getTime()) / 3600000;
    if (ageHours > CONFIG.VERIFY_TTL_HOURS) pending.deleteRow(i + 1);
  }
}
