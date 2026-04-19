# StayTheWay — 7 Pillars of a Faithful Woman — Teaching Assets

Files in this folder (upload to `staytheway.com/teachings/7-pillars-woman/`):

| File | Public URL once uploaded |
|---|---|
| `bingo.html` | https://staytheway.com/teachings/7-pillars-woman/bingo.html |
| `quiz.html` | https://staytheway.com/teachings/7-pillars-woman/quiz.html |
| `prayer.html` | https://staytheway.com/teachings/7-pillars-woman/prayer.html |
| `apps-script.gs` | Paste into Google Apps Script (see below) |

The slide deck contains QR codes that point to those three URLs. The QR codes were generated against the exact URLs above — don't change the paths without regenerating the QRs.

---

## One-time setup — Prayer form backend

1. **Create a Google Sheet** called `StayTheWay Prayer + Email List`.
2. Open the Sheet → **Extensions → Apps Script**.
3. Paste the entire contents of `apps-script.gs`. Save.
4. Edit the `CONFIG` block:
   - `SHEET_ID` — copy it from the Sheet's URL (`/d/SHEET_ID/edit`).
   - `NOTIFY_EMAILS` — your prayer-team inbox.
5. **Deploy** → New deployment → type `Web app`:
   - Execute as: **Me**
   - Who has access: **Anyone**
6. Copy the Web App URL it gives you.
7. Open `prayer.html` → replace the `APPS_SCRIPT_URL` constant with the URL from step 6.
8. (Optional) Apps Script → Triggers → add a daily time-driven trigger for `cleanupExpiredPending`.

The Sheet will auto-create three tabs on first use: **Pending**, **Prayers**, **Email List**.

**How double opt-in works:**
- User submits the form → entry goes to `Pending` sheet, verification email is sent.
- User clicks the link in the email → entry moves to `Prayers` (and to `Email List` if they opted in), your prayer team gets a notification email.
- Unverified entries expire after 48 hours and are cleaned up by the optional trigger.

Honeypot field and minimum-time check block most bots client-side.

---

## For next week's teaching

Duplicate this whole folder and rename the slug, e.g. `8-pillars-new-topic`. The Apps Script is generic — it dispatches on the `topic` field in the POST body, so you can re-use the same deployment for every teaching. Just:

1. Copy this folder to `staytheway.com/teachings/NEW-SLUG/`
2. Regenerate the 3 QR codes for the new URLs (run `gen_qr.js` in the build folder, change `TEACHING_SLUG`)
3. Swap the content (bingo terms, quiz questions, verse card) for the new topic
4. Rebuild the slide deck with the new QR pngs

Or use the LOAD PROMPT in the Master Prompts file — Claude will do all of the above automatically.
