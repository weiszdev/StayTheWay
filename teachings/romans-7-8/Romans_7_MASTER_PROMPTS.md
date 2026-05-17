# StayTheWay Teaching Package — Master Prompts
## Current topic: Romans 7 — The Struggle Under the Law
**Date:** May 2026  •  **Key verse:** Romans 7:4 (NKJV)  —  "Therefore, my brethren, you also have become dead to the law through the body of Christ, that you may be married to another—to Him who was raised from the dead, that we should bear fruit to God."

---

## LOAD PROMPT — Paste into Claude to rebuild

```
You are helping me build a complete ministry teaching package for StayTheWay Ministry (staytheway.com).

==== THIS WEEK'S VARIABLES (edit these) ====
TEACHING_TITLE: "Romans 7 — The Struggle Under the Law"
TEACHING_SLUG: "romans-7"
KEY_VERSE_REF: "Romans 7:4"
KEY_VERSE_TEXT: "Therefore, my brethren, you also have become dead to the law through the body of Christ, that you may be married to another—to Him who was raised from the dead, that we should bear fruit to God."
WRAP_UP_REF: "Romans 7:24-25"
WRAP_UP_TEXT: "O wretched man that I am! Who will deliver me from this body of death? I thank God—through Jesus Christ our Lord!"
TRANSLATION: NKJV
CHAPTER: Romans 7 (all 25 verses, full text)
SECTION_COUNT: 9
SECTIONS:
  1. Dead to the Law | 7:1-3
  2. Alive to Christ | 7:4-6
  3. The Law Reveals Sin | 7:7-9
  4. The Law Is Holy | 7:10-12
  5. The War Within | 7:13-15
  6. It Is No Longer I | 7:16-18
  7. Sin That Dwells in Me | 7:19-20
  8. Two Laws at War | 7:21-23
  9. The Cry for Deliverance | 7:24-25

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

==== DECK ORDER (11 slides) ====
  Slide 1:  Title — "Romans 7" + subtitle + key verse below camera
  Slide 2:  WORSHIP — 4 songs split top/bottom around camera
  Slides 3-11: 9 Scripture sections (2-3 verses each, full NKJV text)

==== WORSHIP SONGS ====
  1. Lord, I Need You — Matt Maher (Desperation for Christ — mirrors Paul's cry in 7:24)
  2. Come As You Are — Crowder (No matter the struggle, come to Jesus as you are)
  3. Rescue — Lauren Daigle (Crying out for rescue from the war within)
  4. Graves Into Gardens — Elevation Worship (God turns our deadness under the law into life)

==== DELIVERABLES ====
1. PPTX vertical 9×16 (11 slides as above) — all scripture bold Georgia
2. HTML teaching page — mobile-first, vertical slides, full NKJV text, camera slots, application areas
3. Bible Bingo — /teachings/{TEACHING_SLUG}/bingo.html
   • Interactive 5×5 grid
   • 24 terms from Romans 7 (law, sin, flesh, commandment, death, covetousness, carnal, evil desire, members, captivity, deliver, body of death, Spirit, letter, fruit, husband, adulteress, holy, just, good, mind, inward man, wretched, Jesus Christ)
   • Center FREE space: "DEAD TO THE LAW"
4. Interactive Quiz — /teachings/{TEACHING_SLUG}/quiz.html
   • 8 multiple-choice questions covering each section
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
PPTX → ~/StayTheWay/teachings/romans-7-8/Romans_7_Teaching.pptx

[INSERT WHAT YOU NEED BUILT — or say "build everything" to run the whole pipeline]
```

---

## Worship Songs — Romans 7

| Song | Artist | Connection |
|------|--------|------------|
| Lord, I Need You | Matt Maher | Desperation for Christ — mirrors Paul's cry in 7:24 |
| Come As You Are | Crowder | No matter the struggle, come to Jesus as you are |
| Rescue | Lauren Daigle | Crying out for rescue from the war within |
| Graves Into Gardens | Elevation Worship | God turns our deadness under the law into life |

---

## Image Prompts (Donna AI)

### YouTube Vertical LIVE — 1080x1920
Portrait 1080x1920. Near-black navy background #000014. Top 25%: bold electric blue chrome 3D block text "ROMANS 7" stacked, with a thin white accent line beneath. Middle: a man's silhouette in chains that are cracking and breaking apart, electric blue light breaking through the fractures. Blue-white light rays from above. Lower third: white bold italic text "The Struggle Under the Law". Across the bottom: etched chrome silver "WHO WILL DELIVER ME? — ROMANS 7:24". Bottom strip: "LIVE NOW" in electric blue on black. StayTheWay watermark bottom center. Dramatic, reverent, intense. Electric blue, chrome silver, white only. NO warm tones, NO gold.

### YouTube Vertical EDITED — 1080x1920
Portrait 1080x1920. Deep charcoal gradient (#1A1A1A to #000014). Top: white bold text "THE WAR" above larger electric-blue chrome text "WITHIN". Center: a silhouette torn between two directions — one side dark, one side glowing blue-white. A broken chain link at the figure's feet. Lower: "Romans 7 — The Struggle Under the Law" in white italic. Bottom: StayTheWay logo. Cinematic, editorial.

---

## Song Prompts (Donna AI)

### Worship Song — "Deliver Me"
Write a complete original worship song in the voice of someone struggling between flesh and Spirit, crying out for deliverance. Weave in themes from Romans 7: the law revealing sin, the war between mind and flesh, wanting to do good but failing, the cry "O wretched man that I am!", and the triumphant answer "I thank God—through Jesus Christ our Lord!" Structure: Verse 1, Pre-Chorus, Chorus, Verse 2, Pre-Chorus, Chorus, Bridge, Final Chorus. Tone: Raw, honest, building to triumphant release. Include chord suggestions in key of Em or Am. Original for StayTheWay Ministry.

### Kids Song — "Jesus Sets Me Free"
Write a fun, singable kids worship song for ages 5-7 about how rules show us right from wrong but only Jesus can change our hearts. Themes: I try to do good but sometimes I mess up, Jesus doesn't give up on me, He makes me new inside, I'm free because of Him. Structure: Verse, Chorus, Verse, Chorus, Bridge (with actions), Chorus. Style: Upbeat, bouncy, hand-motion friendly. Include suggested actions in brackets.

---

## Deploy Steps

### 1. Upload HTML suite to SiteGround via SSH
```bash
ssh -i ~/.ssh/siteground_stw -p 18765 u2121-p9x72lgphszm@ssh.staytheway.com
mkdir -p /home/customer/www/staytheway.com/public_html/stw-teachings/romans-7/
```

```bash
scp -i ~/.ssh/siteground_stw -P 18765 \
  index.html bingo.html quiz.html prayer.html verified.html \
  kids-bingo.html kids-quiz.html kids-activity.html \
  u2121-p9x72lgphszm@ssh.staytheway.com:/home/customer/www/staytheway.com/public_html/stw-teachings/romans-7/
```

### 2. Add .htaccess rewrite
```
RewriteRule ^teachings/romans-7/$ /stw-teachings/romans-7/index.html [L]
RewriteRule ^teachings/romans-7/(.*)$ /stw-teachings/romans-7/$1 [L]
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
git commit -m "Add Romans 7 teaching package"
git push origin main
```
