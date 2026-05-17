# StayTheWay Teaching Package — Master Prompts
## Current topic: Romans 8 — Life in the Spirit
**Date:** May 2026  •  **Key verse:** Romans 8:1 (NKJV)  —  "There is therefore now no condemnation to those who are in Christ Jesus, who do not walk according to the flesh, but according to the Spirit."

---

## LOAD PROMPT — Paste into Claude to rebuild

```
You are helping me build a complete ministry teaching package for StayTheWay Ministry (staytheway.com).

==== THIS WEEK'S VARIABLES (edit these) ====
TEACHING_TITLE: "Romans 8 — Life in the Spirit"
TEACHING_SLUG: "romans-8"
KEY_VERSE_REF: "Romans 8:1"
KEY_VERSE_TEXT: "There is therefore now no condemnation to those who are in Christ Jesus, who do not walk according to the flesh, but according to the Spirit."
WRAP_UP_REF: "Romans 8:38-39"
WRAP_UP_TEXT: "For I am persuaded that neither death nor life, nor angels nor principalities nor powers, nor things present nor things to come, nor height nor depth, nor any other created thing, shall be able to separate us from the love of God which is in Christ Jesus our Lord."
TRANSLATION: NKJV
CHAPTER: Romans 8 (all 39 verses, full text)
SECTION_COUNT: 14
SECTIONS:
  1. No Condemnation | 8:1-2
  2. God Sent His Son | 8:3-4
  3. Flesh vs. Spirit | 8:5-6
  4. The Carnal Mind | 8:7-8
  5. The Spirit Dwells in You | 8:9-11
  6. Led by the Spirit | 8:12-14
  7. Abba, Father | 8:15-17
  8. Future Glory | 8:18-21
  9. Groaning for Redemption | 8:22-25
  10. The Spirit Intercedes | 8:26-27
  11. Called According to His Purpose | 8:28-30
  12. If God Is for Us | 8:31-34
  13. More Than Conquerors | 8:35-37
  14. Nothing Can Separate Us | 8:38-39

==== BRAND / DESIGN SYSTEM (do NOT change week-to-week) ====
Colors:
  • Electric Blue #1478F0  (primary)
  • Sky Blue #28A0F0       (secondary)
  • Chrome Silver #DCDCDC  (body text)
  • Near-Black Navy #000014 (background)
  • White #FFFFFF           (accent labels, application header)
All scripture: NKJV, full verse text only, no commentary on slides.
Typography: Arial Black for titles/kickers/labels; Georgia BOLD for all scripture text.

==== FORMAT ====
Slide deck: VERTICAL 9:16 CANVAS — 9.0 × 16.0 inches (matches 1080×1920).
CAMERA SLOT CENTERED on every content slide: 9" wide × 5.05" tall, positioned at y=5.85".
Scripture text fills the TOP zone (y=0.75 to y=5.65) — bold Georgia, 22pt, chrome silver.
APPLICATION label fills the BOTTOM zone (y=11.1 down) — white line + "APPLICATION" in bold white Arial.
Top accent band: Electric Blue, 0.55" tall, contains section title (left) and verse ref (right).
Bottom accent band: White, 0.55" tall, contains "STAYTHEWAY MINISTRY" in navy.
All text on slides is BOLD.

==== DECK ORDER (16 slides) ====
  Slide 1:  Title — "Romans 8" + subtitle + key verse below camera
  Slide 2:  WORSHIP — 4 songs split top/bottom around camera
  Slides 3-16: 14 Scripture sections (2-4 verses each, full NKJV text)

==== WORSHIP SONGS ====
  1. No Longer Slaves — Bethel Music (From bondage to sonship — "I am a child of God" — 8:15)
  2. Who You Say I Am — Hillsong Worship (Identity as children and heirs of God — 8:16-17)
  3. Way Maker — Sinach (The Spirit intercedes and makes a way — 8:26)
  4. Nothing Can Separate — Zach Williams (Direct from 8:38-39 — the crescendo of the chapter)

==== DELIVERABLES ====
1. PPTX vertical 9×16 (16 slides as above) — all scripture bold Georgia
2. HTML teaching page — mobile-first, vertical slides, full NKJV text, camera slots, application areas
3. Bible Bingo — /teachings/{TEACHING_SLUG}/bingo.html
   • Interactive 5×5 grid
   • 24 terms from Romans 8 (condemnation, Spirit, flesh, law, life, peace, righteousness, adoption, Abba, heirs, glory, creation, hope, intercession, purpose, predestined, justified, glorified, conquerors, love, tribulation, persecution, angels, principalities)
   • Center FREE space: "NO CONDEMNATION"
4. Interactive Quiz — /teachings/{TEACHING_SLUG}/quiz.html
   • 10 multiple-choice questions covering each section
5. Prayer Request form — /teachings/{TEACHING_SLUG}/prayer.html
6. Kids Bible Bingo — /teachings/{TEACHING_SLUG}/kids-bingo.html (4×4, emoji, ages 5-10)
7. Kids Bible Quiz — /teachings/{TEACHING_SLUG}/kids-quiz.html (5 easy questions)
8. Kids Activity Page — /teachings/{TEACHING_SLUG}/kids-activity.html
9. Landing Page — /teachings/{TEACHING_SLUG}/index.html (card hub + YouTube embed)
10. Verification page — /teachings/{TEACHING_SLUG}/verified.html

==== OG META TAGS (required on ALL HTML deliverables) ====
Every .html file MUST include:
  • og:type = "website"
  • og:title = page-specific title
  • og:description = page-specific description
  • og:image = "https://res.cloudinary.com/dyq7rnjjw/image/upload/c_fill,w_1200,h_630,g_center,q_auto,f_jpg/v1775094378/IMG_2196_waiddo.png"
  • og:url = "https://staytheway.com/teachings/{TEACHING_SLUG}/{filename}"
  • og:site_name = "StayTheWay"
  • twitter:card = "summary_large_image"

==== SECURITY / SPAM CONTROLS (prayer form) ====
  • Honeypot field hidden from humans
  • Minimum 2.5s time-on-page before submit
  • Max 3 pending verifications per email
  • Double opt-in via email verification link

==== OUTPUT LOCATION ====
All HTML assets → ~/StayTheWay/teachings/romans-7-8/
PPTX → ~/StayTheWay/teachings/romans-7-8/Romans_8_Teaching.pptx

[INSERT WHAT YOU NEED BUILT — or say "build everything" to run the whole pipeline]
```

---

## Worship Songs — Romans 8

| Song | Artist | Connection |
|------|--------|------------|
| No Longer Slaves | Bethel Music | From bondage to sonship — "I am a child of God" (8:15) |
| Who You Say I Am | Hillsong Worship | Identity as children and heirs of God (8:16-17) |
| Way Maker | Sinach | The Spirit intercedes and makes a way (8:26) |
| Nothing Can Separate | Zach Williams | Direct from 8:38-39 — the crescendo of the chapter |

---

## Image Prompts (Donna AI)

### YouTube Vertical LIVE — 1080x1920
Portrait 1080x1920. Near-black navy background #000014. Top 25%: bold electric blue chrome 3D block text "ROMANS 8" stacked, with a thin white accent line beneath. Middle: a figure standing with arms outstretched, chains shattered at their feet, brilliant blue-white light radiating outward from their chest. Dove silhouette descending from above in pure white. Lower third: white bold italic text "Life in the Spirit". Across the bottom: etched chrome silver "NO CONDEMNATION — ROMANS 8:1". Bottom strip: "LIVE NOW" in electric blue on black. StayTheWay watermark bottom center. Triumphant, free, powerful. Electric blue, chrome silver, white only. NO warm tones.

### YouTube Vertical EDITED — 1080x1920
Portrait 1080x1920. Deep charcoal gradient (#1A1A1A to #000014). Top: white bold text "MORE THAN" above larger electric-blue chrome text "CONQUERORS". Center: a crown descending, made of blue-white light, onto the silhouette of a person kneeling in worship. Shattered chains scattered around them. Lower: "Romans 8 — Life in the Spirit" in white italic. Bottom: StayTheWay logo. Cinematic, triumphant.

### Song Thumbnail Wide — 1920x1080
Cinematic worship thumbnail 1920x1080. Black background with warm blue-white light rays from center. A dove in flight, wings spread wide, backlit with brilliant white. Above: "NO CONDEMNATION" in bold white chrome 3D with electric blue glow. Below in chrome silver italic: "A Worship Declaration | StayTheWay Ministry".

---

## Song Prompts (Donna AI)

### Worship Song (Adult) — "No Condemnation"
Write a complete original worship song celebrating total freedom in Christ. Weave in themes from Romans 8: no condemnation, the Spirit of life, flesh vs. Spirit, adoption as sons, crying "Abba Father", heirs with Christ, sufferings not worthy to be compared with glory, the Spirit interceding with groans, all things working together, more than conquerors, nothing can separate us from His love. Structure: Verse 1 (freedom from condemnation), Pre-Chorus (the Spirit testifies), Chorus (nothing can separate), Verse 2 (heirs and glory), Pre-Chorus, Chorus, Bridge (build on 8:38-39 declaration — neither death nor life...), Final Chorus (triumphant). Tone: Starts intimate, builds to anthemic, corporate worship crescendo. Include chord suggestions in key of G or A major. Original for StayTheWay Ministry.

### Kids Song — "I Am God's Child"
Write a fun, joyful, singable kids worship song for ages 5-7 about being a child of God and nothing being able to take away His love. Themes: God chose me, I can call Him "Abba Daddy", His Spirit lives in me, even when I'm scared He's with me, nothing in the whole wide world can separate me from His love — not monsters, not storms, not anything! Structure: Verse, Chorus, Verse, Chorus, Bridge (with actions — stamp feet for "nothing!", hands up for "His love!"), Chorus. Style: Upbeat, bouncy, hand-motion friendly. Include suggested actions in brackets.

---

## Deploy Steps

### 1. Upload HTML suite to SiteGround via SSH
```bash
ssh -i ~/.ssh/siteground_stw -p 18765 u2121-p9x72lgphszm@ssh.staytheway.com
mkdir -p /home/customer/www/staytheway.com/public_html/stw-teachings/romans-8/
```

```bash
scp -i ~/.ssh/siteground_stw -P 18765 \
  index.html bingo.html quiz.html prayer.html verified.html \
  kids-bingo.html kids-quiz.html kids-activity.html \
  u2121-p9x72lgphszm@ssh.staytheway.com:/home/customer/www/staytheway.com/public_html/stw-teachings/romans-8/
```

### 2. Add .htaccess rewrite
```
RewriteRule ^teachings/romans-8/$ /stw-teachings/romans-8/index.html [L]
RewriteRule ^teachings/romans-8/(.*)$ /stw-teachings/romans-8/$1 [L]
```

### 3. Flush SiteGround cache
```bash
ssh -i ~/.ssh/siteground_stw -p 18765 u2121-p9x72lgphszm@ssh.staytheway.com \
  "wp cache flush --path=/home/customer/www/staytheway.com/public_html && \
   wp litespeed-option set cache false --path=/home/customer/www/staytheway.com/public_html && \
   wp litespeed-option set cache true --path=/home/customer/www/staytheway.com/public_html"
```

### 4. Commit to git
```bash
cd ~/StayTheWay
git add teachings/romans-7-8/
git commit -m "Add Romans 8 teaching package"
git push origin main
```

---

## Companion Teaching

This is Part 2 of a two-part series. Romans 7 (The Struggle Under the Law) sets up the tension; Romans 8 (Life in the Spirit) delivers the resolution. Together they form a complete arc: from bondage → war within → cry for deliverance → no condemnation → life in the Spirit → nothing can separate us.
