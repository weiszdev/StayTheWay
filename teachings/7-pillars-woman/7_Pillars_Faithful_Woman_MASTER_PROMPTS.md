# StayTheWay Teaching Package — Master Prompts
## Current topic: 7 Pillars of a Faithful Woman — Toward Her Husband
**Date:** April 2026  •  **Key verse:** John 10:27 (NKJV)  —  "My sheep hear My voice, and I know them, and they follow Me."

---

## 🔁 LOAD PROMPT — Paste into Claude to rebuild any week

This prompt rebuilds the FULL teaching package: slide deck + HTML teaching page + Bible Bingo + Interactive Quiz + Prayer Request form + QR codes. Just change the `[…]` variables at the top for each new topic.

```
You are helping me build a complete ministry teaching package for StayTheWay Ministry (staytheway.com).

==== THIS WEEK'S VARIABLES (edit these) ====
TEACHING_TITLE: "7 Pillars of a Faithful Woman — Toward Her Husband"
TEACHING_SLUG: "7-pillars-woman"      // used in URLs and filenames
KEY_VERSE_REF: "John 10:27"
KEY_VERSE_TEXT: "My sheep hear My voice, and I know them, and they follow Me."
WRAP_UP_REF: "John 10:27–28"
COMPANION_REF: "Ephesians 5:33"
PILLAR_COUNT: 7
PILLARS:  // title | scripture ref | verse text | contrast figure
  1. She Hears Her Shepherd's Voice | John 10:27 | "My sheep hear My voice..." | Eve
  2. She Honors and Reverences Her Husband | Ephesians 5:33 | "...let the wife see that she respects her husband." | Michal
  3. She Builds Her House, Never Tears It Down | Proverbs 14:1 | "The wise woman builds her house..." | Jezebel
  4. She Adorns the Hidden Heart | 1 Peter 3:3–4 | "...the hidden person of the heart..." | Sapphira
  5. She Wins Him Without a Word | 1 Peter 3:1–2 | "...without a word, may be won..." | Job's wife
  6. She Does Him Good All the Days of Her Life | Proverbs 31:10–12 | "...she does him good and not evil..." | Delilah
  7. She Looks Forward, Never Back | Luke 17:32 • Phil 3:13–14 | "Remember Lot's wife." | Lot's wife

==== BRAND / DESIGN SYSTEM (do NOT change week-to-week) ====
Colors:
  • Electric Blue #1478F0  (primary)
  • Sky Blue #28A0F0       (secondary)
  • Chrome Silver #DCDCDC  (neutral)
  • Near-Black Navy #000014 (background)
  • Soft Rose #F4B6C9      (accent — feminine series) / omit on men's series
All scripture: NKJV, full verse text only, no commentary on slides.
Typography: Arial Black for titles/kickers; Georgia italic bold for scripture.

==== FORMAT ====
Slide deck: VERTICAL 9:16 CANVAS — 9.0 × 16.0 inches (matches 1080×1920).
Center camera slot on every slide (16:9 at ~9"×5" centered ~y=5.85 to 10.90).
Info split TOP and BOTTOM around the camera slot.
No tiny footer text — just top/bottom accent bands (blue + rose).

==== DECK ORDER ====
  Slide 1: Title + key verse card at bottom
  Slide 2: BIBLE BINGO invite + QR code (big QR, URL, scan CTA)
  Slides 3–9: 7 Pillars (each = kicker/ref, big title, scripture card, camera, contrast ribbon, key-verse echo tied back to KEY_VERSE_TEXT)
  Slide 10: WRAP-UP (WRAP_UP_REF + call to action)
  Slide 11: PRAYER REQUEST invite + QR code
  Slide 12: TAKE THE QUIZ invite + QR code

==== DELIVERABLES ====
1. PPTX vertical 9×16 (12 slides as above)
2. HTML teaching page — mobile-first, all scripture displayed, brand-styled
3. Bible Bingo — /teachings/{TEACHING_SLUG}/bingo.html
   • Interactive 5×5 grid
   • 24 terms pulled from the teaching + names of contrast figures + key scripture refs
   • Center is a FREE space labeled with a keyword from KEY_VERSE_TEXT
   • Shuffle + clear buttons, win detection (rows/cols/diagonals)
4. Interactive Quiz — /teachings/{TEACHING_SLUG}/quiz.html
   • 8 multiple-choice questions covering key verse + each pillar + principle
   • Instant feedback with explanation, progress bar, final score screen
5. Prayer Request form — /teachings/{TEACHING_SLUG}/prayer.html
   • Name, email, request, optional email-list opt-in
   • Honeypot + minimum-time anti-bot
   • POSTs to Google Apps Script backend for double opt-in verification
   • Verified entries land in a Google Sheet ("Prayers" tab); opted-in emails land in "Email List" tab
6. Google Apps Script backend — /teachings/{TEACHING_SLUG}/apps-script.gs
   • doPost receives form, stores PENDING entry, emails verification link
   • doGet receives verify click, moves entry to Prayers + Email List, notifies prayer team
   • 48-hour TTL on pending, generic enough to be reused across every teaching (keyed by `topic` field)
7. Three QR codes generated with the `qrcode` npm package:
   • Black squares on white background (standard scanner orientation)
   • Error correction level H
   • Pointing to https://staytheway.com/teachings/{TEACHING_SLUG}/{bingo|prayer|quiz}.html
8. Kids Bible Bingo — /teachings/{TEACHING_SLUG}/kids-bingo.html
   • Simpler 4×4 grid with emoji icons and age-appropriate terms (ages 5-10)
   • Tap to mark, win detection, shuffle + reset
9. Kids Bible Quiz — /teachings/{TEACHING_SLUG}/kids-quiz.html
   • 5 easy multiple-choice questions with emoji feedback
   • Age-appropriate language, Bible verse references, final score screen
10. Kids Activity Page — /teachings/{TEACHING_SLUG}/kids-activity.html
    • Color the pillars (tap to paint with selected color)
    • Trace the key verse (finger/mouse drawing canvas)
    • Draw your prayer (freeform drawing canvas)
11. Landing Page — /teachings/{TEACHING_SLUG}/index.html
    • Card-based hub linking to all resources (adult + kids)
    • Embedded YouTube teaching video at the top
    • Each card has emoji icon, title, description, and colored tag
    • OG meta tags for iOS link preview cards
12. Verification page — /teachings/{TEACHING_SLUG}/verified.html
    • Thank-you page shown after prayer verification
    • Calls Apps Script in background via fetch (avoids Google iframe on iOS)
13. README with upload + Apps Script deployment steps

==== OG META TAGS (required on ALL HTML deliverables) ====
Every .html file MUST include these in <head> after the description meta tag:
  • og:type = "website"
  • og:title = page-specific title
  • og:description = page-specific description
  • og:image = "https://res.cloudinary.com/dyq7rnjjw/image/upload/c_fill,w_1200,h_630,g_center,q_auto,f_jpg/v1775094378/IMG_2196_waiddo.png"
  • og:url = "https://staytheway.com/teachings/{TEACHING_SLUG}/{filename}"
  • og:site_name = "StayTheWay"
  • twitter:card = "summary_large_image"
  • twitter:title, twitter:description, twitter:image (same values as OG)
This ensures proper iOS link preview cards when links are shared via iMessage, social media, etc.

==== YOUTUBE EMBED ====
The landing page (index.html) embeds the YouTube teaching video.
Variable: YOUTUBE_ID (e.g., "XuLetJBP554")
Embed URL: https://www.youtube.com/embed/{YOUTUBE_ID}
Placed in a 16:9 responsive iframe above the resource cards.

==== SECURITY / SPAM CONTROLS (prayer form) ====
  • Honeypot field hidden from humans (rejected if filled)
  • Minimum 2.5s time-on-page before submit
  • Max 3 pending verifications per email
  • Double opt-in: nothing saves until the user clicks the email link
  • Pending entries expire in 48 hours (optional daily cleanup trigger)

==== OUTPUT LOCATION ====
All HTML assets → /mnt/outputs/staytheway/teachings/{TEACHING_SLUG}/
PPTX → /mnt/outputs/7_Pillars_{SLUG}_VERTICAL_v3_FULL916_QR.pptx
Master prompts → /mnt/outputs/7_Pillars_{SLUG}_MASTER_PROMPTS.md

==== WHEN DONE ====
• Document everything in a Notion page under "Nonprofit Structure & Tax Strategy Session — April 3, 2026"
• Link the new package to last week's teaching for continuity
• Leave me clear upload instructions (local files only — do not attempt to push to GitHub from the VM)

[INSERT WHAT YOU NEED BUILT — or say "build everything" to run the whole pipeline]
```

---

## Current week's package — what's built

### Slide deck (12 slides, vertical 9:16)
1. Title — key verse John 10:27
2. **Bible Bingo invite + QR** → staytheway.com/teachings/7-pillars-woman/bingo
3. Pillar 1 — She Hears Her Shepherd's Voice (Eve)
4. Pillar 2 — She Honors and Reverences Her Husband (Michal)
5. Pillar 3 — She Builds Her House (Jezebel)
6. Pillar 4 — She Adorns the Hidden Heart (Sapphira)
7. Pillar 5 — She Wins Him Without a Word (Job's wife)
8. Pillar 6 — She Does Him Good All Her Days (Delilah)
9. Pillar 7 — She Looks Forward, Never Back (Lot's wife)
10. Wrap-Up — John 10:27–28
11. **Prayer Request invite + QR** → staytheway.com/teachings/7-pillars-woman/prayer
12. **Take the Quiz invite + QR** → staytheway.com/teachings/7-pillars-woman/quiz

### Interactive HTML suite (upload to staytheway.com/teachings/7-pillars-woman/)
- `bingo.html` — 5×5 grid, 24 terms + My Voice free space, win detection, shuffle
- `quiz.html` — 8 questions, instant feedback, final score with blessing
- `prayer.html` — form + honeypot + double opt-in email verification
- `apps-script.gs` — Google Apps Script backend for prayer + email list
- `README.md` — deployment + setup steps

### QR codes (built into the deck)
- Standard black-on-white, error correction H, scannable from the slide
- Generated by `build/gen_qr.js` using the `qrcode` npm package

---

## Image Prompts (Donna AI) — vertical primary

### YouTube Vertical LIVE — 1080x1920
Portrait 1080x1920. Near-black navy background #000014. Top 25%: bold electric blue chrome 3D block text "7 PILLARS" stacked, with a thin soft-rose accent line beneath. Middle: a single tall Roman pillar glowing from within in blue-white light; at the base of the pillar, a woman's silhouette with bowed head in a posture of listening, soft blue-white light rays descending from above onto her. Lower third: white italic text "of a Faithful Woman — Toward Her Husband". Across the bottom of the pillar, etched in chrome silver: "MY SHEEP HEAR MY VOICE — JOHN 10:27". Bottom strip: "LIVE NOW" in electric blue on black. StayTheWay watermark bottom center. Reverent, strong. Electric blue, chrome silver, soft rose accent only. NO pink-dominated palette, NO gold.

### YouTube Vertical EDITED — 1080x1920
Portrait 1080x1920. Deep charcoal gradient background (#1A1A1A to #000014). Top: white bold text "DO YOU" above larger electric-blue chrome text "HEAR HIM?" Center: 7 glowing blue pillars arranged in a gentle arc, the center pillar slightly taller and brighter. A woman's silhouette stands inside the center pillar, head tilted upward. Lower: "7 Pillars of a Faithful Woman" in white italic with a single soft-rose underline. Bottom: StayTheWay logo. Cinematic, editorial.

### Song Thumbnail Wide — 1920x1080
Cinematic worship thumbnail 1920x1080. Black background with soft electric blue light rays from center. Seven stone pillars in silhouette, backlit blue-white. Above: "HE IS WORTHY" in bold white chrome 3D with electric blue glow. Below in chrome silver italic: "A Worship Declaration | StayTheWay Ministry".

---

## Song Prompts (Donna AI)

### Worship Song (Adult) — "He Is Worthy"
Write a complete original worship song — not first-person "I" — in second and third person declaring the Shepherd's voice, His worthiness, His faithfulness, and the beauty of the heart that hears Him. Weave in themes from the 7 pillars: hearing His voice, honoring in reverence, building the house, hidden heart adorned, winning without a word, doing good all her days, looking forward never back. Structure: Verse 1, Pre-Chorus, Chorus, Verse 2, Pre-Chorus, Chorus, Bridge, Final Chorus. Tone: Reverent, anthemic, corporate worship. Include chord suggestions in key of D or E major. Original for StayTheWay Ministry.

### Kids Song — "I Hear His Voice"
Write a fun, joyful, singable kids worship song for ages 5–7 about hearing Jesus the Good Shepherd and following Him. Themes: Jesus is my Shepherd, I can be kind and brave at home, my words can build or break, my heart is beautiful when it's quiet with God, I look forward not back. Structure: Verse, Chorus, Verse, Chorus, Bridge (with actions), Chorus. Style: Upbeat, bouncy, hand-motion friendly. Include suggested actions in brackets.

---

## Deploy Steps (each week)

### 1. Upload HTML suite to SiteGround via SSH
```bash
# SSH into SiteGround
ssh -i ~/.ssh/siteground_stw -p 18765 u2121-p9x72lgphszm@ssh.staytheway.com

# Create the folder (files go in stw-teachings to avoid WordPress slug conflicts)
mkdir -p /home/customer/www/staytheway.com/public_html/stw-teachings/{TEACHING_SLUG}/

# Upload from local machine
scp -i ~/.ssh/siteground_stw -P 18765 bingo.html quiz.html prayer.html verified.html \
  u2121-p9x72lgphszm@ssh.staytheway.com:/home/customer/www/staytheway.com/public_html/stw-teachings/{TEACHING_SLUG}/
```

### 2. Add .htaccess rewrite (first time only for new slugs)
Add inside the `# BEGIN StayTheWay Teachings Rewrite` block in `/public_html/.htaccess`:
```
RewriteRule ^teachings/{TEACHING_SLUG}/(.*\.html)$ /stw-teachings/{TEACHING_SLUG}/$1 [L]
```
This maps the public URL `staytheway.com/teachings/{TEACHING_SLUG}/` to the physical files without conflicting with the WordPress "Teachings" page.

### 3. Apps Script backend (reuse existing project)
- Open https://script.google.com — project "staythewayprayer"
- The script is topic-agnostic (uses the `topic` field from the form POST). No code changes needed week-to-week.
- **If a new teaching needs its own Google Sheet:** create one, update `CONFIG.SHEET_ID`
- **If reusing the same sheet:** no changes needed — all teachings share the same Prayers/Email List/Pending tabs, distinguished by the `topic` column
- Update `CONFIG.VERIFY_PAGE` to point to the new teaching's `verified.html`
- Save, Deploy → New deployment → Web app (Execute as Me, Access Anyone)
- Update `APPS_SCRIPT_URL` in both `prayer.html` and `verified.html` with the new deployment URL
- Re-upload both files to SiteGround

### 4. Flush SiteGround cache
```bash
ssh -i ~/.ssh/siteground_stw -p 18765 u2121-p9x72lgphszm@ssh.staytheway.com \
  "wp cache flush --path=/home/customer/www/staytheway.com/public_html && \
   wp litespeed-option set cache false --path=/home/customer/www/staytheway.com/public_html && \
   wp litespeed-option set cache true --path=/home/customer/www/staytheway.com/public_html"
```

### 5. Commit to git
```bash
cd ~/StayTheWay
git add teachings/{TEACHING_SLUG}/
git commit -m "Add {TEACHING_TITLE} teaching package"
git push origin main
```

### 6. Use the deck
Open the PPTX in OBS or your streaming tool. The camera composites into the centered camera slot. QR codes on slides 2, 11, 12 are live and scannable.

### Key lessons learned
- **WordPress slug conflicts:** Never put files in `/public_html/teachings/` directly — it overrides the WordPress "Teachings" page. Use `/stw-teachings/` with a rewrite rule.
- **iOS Safari blocks Apps Script iframes:** The `HtmlService.createHtmlOutput()` renders inside a Google sandboxed iframe that iOS Safari blocks. Always redirect verification to a page hosted on staytheway.com that calls Apps Script in the background via `fetch()` with `mode: "no-cors"`.
- **Apps Script POST returns 302:** Browsers convert the redirect from POST to GET, breaking JSON responses. Use `mode: "no-cors"` for form submissions and show success optimistically after client-side validation.
- **SiteGround cache is aggressive:** Always flush after uploading files. Use `wp cache flush` + LiteSpeed toggle. Tell users to hard-refresh (Cmd+Shift+R).
- **Apps Script deployments are versioned:** Saving code does NOT update an existing deployment. You must create a new deployment or edit the existing one and change version to "New version."
- **Hourly follow-up trigger:** A time-driven trigger runs `sendFollowups()` every hour, emailing people 24 hours after verification asking how to keep praying for them. Replies go to info@staytheway.com.

---

## Companion teaching (last week)

This is paired with last week's ["7 Pillars of a Faithful Man — Teaching Package"](https://www.notion.so/3407fe8317af816e8c14ce18c8be8739). The two together form a full marriage teaching unit. Man's teaching is horizontal; Woman's is vertical. Both rest on the same principle: *faithfulness to God is independent of the spouse's response*.
