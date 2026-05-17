# StayTheWay — Sunday Build-Out
**Date:** 2026-05-17 (Sunday)
**Topic:** Romans 8 — Life in the Spirit
**Status:** Build-out (full 10-deliverable pipeline)
**Local folder:** `~/StayTheWay/teachings/romans-7-8/`
**Pulled from Notion:** 2026-05-17 — Master Teaching Prompt + Site Revamp & Build Guide consolidated below

---

## A. NOTION CONTEXT — Master Teaching Prompt
*(from Notion page: "Stay The Way — Master Teaching Prompt", 3327fe83-17af-8167-adcb-eab9bd60da8b)*

**Ministry:** Stay The Way — 501(c)(3) Nonprofit Ministry, North Dakota
**Teacher:** Jonathan Weisz
**Platform:** NotDrWise (Holy Spirit Lead Health Ministry)
**Mission:** Equip ALL believers — Acts 2:42 home Bible studies, biblical wisdom + functional health.
**Motto:** "Learn how to think, not what to think."

### Jonathan's Teaching Style
- Teaches by TALKING POINTS, not reading slides
- Direct, masculine, framework-based thinking
- Faith-grounded but not preachy or churchy
- Real biblical examples with modern application
- Asks hard questions men won't ask themselves
- Slides: bold statement, person's name, scripture reference, visual. NOT paragraphs.

### Brand / Design (current — Romans 7-8 series)
- **Colors:** Electric Blue #1478F0, Sky Blue #28A0F0, Chrome Silver #DCDCDC, Near-Black Navy #000014, White #FFFFFF
- **Typography:** Arial Black for titles; Georgia BOLD for all scripture text
- **Scripture:** NKJV, full verse text, no commentary on slides
- **Format:** Vertical 9:16 canvas (9.0 × 16.0 in / 1080×1920) with centered camera slot

---

## B. THIS WEEK'S LOAD PROMPT — Romans 8
*(canonical copy lives in `Romans_8_MASTER_PROMPTS.md` in this folder — paste this block into a fresh Claude session to rebuild)*

```
You are helping me build a complete ministry teaching package for StayTheWay Ministry (staytheway.com).

==== THIS WEEK'S VARIABLES ====
TEACHING_TITLE: "Romans 8 — Life in the Spirit"
TEACHING_SLUG: "romans-8"
KEY_VERSE_REF: "Romans 8:1"
KEY_VERSE_TEXT: "There is therefore now no condemnation to those who are in Christ Jesus, who do not walk according to the flesh, but according to the Spirit."
WRAP_UP_REF: "Romans 8:38-39"
TRANSLATION: NKJV
CHAPTER: Romans 8 (all 39 verses)
SECTION_COUNT: 14

SECTIONS:
  1. No Condemnation              | 8:1-2
  2. God Sent His Son             | 8:3-4
  3. Flesh vs. Spirit             | 8:5-6
  4. The Carnal Mind              | 8:7-8
  5. The Spirit Dwells in You     | 8:9-11
  6. Led by the Spirit            | 8:12-14
  7. Abba, Father                 | 8:15-17
  8. Future Glory                 | 8:18-21
  9. Groaning for Redemption      | 8:22-25
  10. The Spirit Intercedes       | 8:26-27
  11. Called According to Purpose | 8:28-30
  12. If God Is for Us            | 8:31-34
  13. More Than Conquerors        | 8:35-37
  14. Nothing Can Separate Us     | 8:38-39

WORSHIP SONGS:
  1. No Longer Slaves — Bethel Music (8:15)
  2. Who You Say I Am — Hillsong Worship (8:16-17)
  3. Way Maker — Sinach (8:26)
  4. Nothing Can Separate — Zach Williams (8:38-39)

==== 10 DELIVERABLES ====
  1.  Romans_8_Teaching.pptx       — vertical 9×16, 16 slides
  2.  romans-8/index.html          — landing page
  3.  romans-8/bingo.html          — adult bingo (FREE = "NO CONDEMNATION")
  4.  romans-8/quiz.html           — 10 MC questions
  5.  romans-8/prayer.html         — request form + honeypot + double opt-in
  6.  romans-8/verified.html       — email verification
  7.  romans-8/kids-bingo.html     — 4×4, emoji, ages 5-10
  8.  romans-8/kids-quiz.html      — 5 easy questions
  9.  romans-8/kids-activity.html  — kids activity page
  10. teaching.html                — combined teaching page (parent folder)

OG META on every HTML:
  og:image = https://res.cloudinary.com/dyq7rnjjw/image/upload/c_fill,w_1200,h_630,g_center,q_auto,f_jpg/v1775094378/IMG_2196_waiddo.png
  og:url   = https://staytheway.com/teachings/{TEACHING_SLUG}/{filename}

Output location: ~/StayTheWay/teachings/romans-7-8/
```

---

## C. DEPLOY STEPS (Terminal-ready)

```bash
# 1. SSH into SiteGround
ssh -i ~/.ssh/siteground_stw -p 18765 u2121-p9x72lgphszm@ssh.staytheway.com
mkdir -p /home/customer/www/staytheway.com/public_html/stw-teachings/romans-8/

# 2. Upload HTML suite (run from local ~/StayTheWay/teachings/romans-7-8/romans-8/)
scp -i ~/.ssh/siteground_stw -P 18765 \
  index.html bingo.html quiz.html prayer.html verified.html \
  kids-bingo.html kids-quiz.html kids-activity.html \
  u2121-p9x72lgphszm@ssh.staytheway.com:/home/customer/www/staytheway.com/public_html/stw-teachings/romans-8/

# 3. Add to .htaccess
#   RewriteRule ^teachings/romans-8/$ /stw-teachings/romans-8/index.html [L]
#   RewriteRule ^teachings/romans-8/(.*)$ /stw-teachings/romans-8/$1 [L]

# 4. Flush SiteGround / LiteSpeed cache
ssh -i ~/.ssh/siteground_stw -p 18765 u2121-p9x72lgphszm@ssh.staytheway.com \
  "wp cache flush --path=/home/customer/www/staytheway.com/public_html && \
   wp litespeed-option set cache false --path=/home/customer/www/staytheway.com/public_html && \
   wp litespeed-option set cache true --path=/home/customer/www/staytheway.com/public_html"

# 5. Commit to git
cd ~/StayTheWay
git add teachings/romans-7-8/
git commit -m "Add Romans 8 teaching package (Sunday 2026-05-17 build)"
git push origin main
```

---

## D. BUILD STATUS — pulled 2026-05-17
*(snapshot of files in `~/StayTheWay/teachings/romans-7-8/` at time of build-out)*

| # | Deliverable                          | File                                | Built? |
|---|--------------------------------------|-------------------------------------|--------|
| 1 | Romans 8 PPTX                        | Romans_8_Teaching.pptx              | YES    |
| 2 | Romans 8 landing                     | romans-8/index.html                 | YES    |
| 3 | Adult bingo                          | romans-8/bingo.html                 | YES    |
| 4 | Adult quiz                           | romans-8/quiz.html                  | YES    |
| 5 | Prayer form                          | romans-8/prayer.html                | YES    |
| 6 | Email verified                       | romans-8/verified.html              | YES    |
| 7 | Kids bingo                           | romans-8/kids-bingo.html            | YES    |
| 8 | Kids quiz                            | romans-8/kids-quiz.html             | YES    |
| 9 | Kids activity                        | romans-8/kids-activity.html         | YES    |
| 10| Combined teaching page (parent)      | teaching.html                       | YES    |

Worship companion (already built):
- Through_Jesus_Christ_Our_Lord_song.md (Romans 7 anthem, A / 74 BPM)
- If_God_Is_For_Us_song.md (Romans 8 anthem, D / 78 BPM)

---

## E. NEXT ACTIONS — Sunday
1. Open `sunday-buildout.sh` for one-shot deploy commands.
2. If any deliverable needs rebuild → paste the LOAD PROMPT (section B) into a fresh Claude session with the specific deliverable name appended.
3. After deploy, smoke-test:
   - https://staytheway.com/teachings/romans-8/
   - https://staytheway.com/teachings/romans-8/bingo.html
   - https://staytheway.com/teachings/romans-8/quiz.html
4. Tag git: `git tag romans-8-sunday-2026-05-17 && git push --tags`
