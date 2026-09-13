# SUNDAY BUILDOUT — 2026-09-13
**Project:** StayTheWay
**Teaching:** Rejoicing on Every Side (Psalm 65:11–13 · Proverbs 13:1)
**Slug:** `rejoicing`
**Working directory:** `~/StayTheWay/teachings/rejoicing/`

Single-page terminal reference for today's build, following the same shape as the Romans 8 Sunday buildout: (A) Notion master-prompt context, (B) this teaching's LOAD PROMPT, (C) terminal deploy steps, (D) build status table, (E) next actions.

---

## (A) Notion Master Prompt Context

**Ministry:** Stay The Way — 501(c)(3) service ministry, North Dakota (not a church). Motto: "Learn how to think, not what to think."
**Founder / Teacher:** Jonathan C. Weisz
**Platform note:** WordPress (staytheway.com) stays for domain authority/SEO/email signup; the teaching hub itself is standalone HTML on GitHub Pages — `weiszdev/StayTheWay` repo, served at `weiszdev.github.io/StayTheWay/`.
**Design tokens (site):** Inter (body) / Playfair Display (headings); navy `#0f172a`, slate `#1e293b`, amber `#f59e0b`, gold `#fbbf24`, white `#f8fafc`. Tailwind via CDN, no build tools, self-contained HTML+CSS+JS per page.
**Design tokens (slide decks / PPTX_PROMPT conventions):** vertical 9:16, camera-safe zone at the bottom of every slide, no wordmark clutter, QR codes placed early (2 per slide) when a teaching package includes them.
**Notion sources:** "Stay The Way — Master Teaching Prompt" and "StayTheWay Master Prompt — Site Revamp & Build Guide," both archived under MASTER EXECUTION HUB — Stay The Way × NotDrWise.

---

## (B) Rejoicing on Every Side — LOAD PROMPT

Paste this block into a fresh Claude session to pick this teaching back up with full context:

```
TEACHING: Rejoicing on Every Side
SLUG: rejoicing
DATE: Sunday, September 13, 2026
ANCHOR VERSE: Psalm 65:11–13 (compared across KJV, NKJV, NIV, ESV)
SUPPORTING: Proverbs 13:1

CORE THEME: A reset for when we've lost our way — staying close enough,
daily, to keep hearing the Father, so the overflow of God's goodness
(Ps 65:11) reaches even our wilderness seasons (Ps 65:12) and produces
total, visible joy (Ps 65:13).

STRUCTURE — 3 steps:
1. THE DIAGNOSIS — Proverbs 13:1 (wise son vs. scorner); Deuteronomy
   6:6–9 (instruction woven through the day); Psalm 55:17 + Daniel 6:10
   (morning/noon/night rhythm); what quietly drains when we skip it.
2. THE METAPHOR — phone battery / daily food as recharge pictures;
   Matthew 4:4; Genesis 1:26–27 (emotions as part of the image of God);
   the Word as regulator; physical fallout of ungoverned emotion —
   Proverbs 14:30, Proverbs 17:22, Psalm 32:3–4, Psalm 38:3.
3. THE RESET — Psalm 65:12 across 4 translations, then back to 65:11
   (God's action first) and forward to 65:13 (completion); Romans 12:2
   as the renewal mechanism.

FRAMEWORK / ACRONYM: none assigned yet — candidate for a memorable
device (see Master Teaching Prompt pattern: GUARD, R3, BENR) if this
becomes a series.

DELIVERABLES BUILT:
- Teaching script, 3-step outline + full vertical (9:16) script —
  Sunday-Reset-Rejoicing-on-Every-Side.md
- Slide deck, 27 slides, vertical 9:16, camera-safe bottom zone, bold
  type throughout — Rejoicing-on-Every-Side.pptx

DELIVERABLES PENDING (standard StayTheWay teaching package):
- Mobile-first teaching HTML page (staytheway.com/teachings/rejoicing/)
- Interactive quiz (HTML)
- Bingo card
- Prayer card
- QR code set (prayer / bingo / quiz / subscribe)
- Kids version (bingo / quiz / activity)

WHEN BUILDING FURTHER: follow the Teaching Template — teaching doc
(.md) with scripture references, PPTX slides (talking-point style,
visual motif matching the theme), interactive HTML quiz (2 questions:
1 knowledge, 1 application) — then archive session notes to Notion
under MASTER EXECUTION HUB.
```

---

## (C) Terminal Deploy Steps

Deployed 2026-09-13 with the helper (real SiteGround details are baked in):

```bash
cd ~/StayTheWay/teachings/rejoicing
./sunday-buildout.sh status    # file checklist
./sunday-buildout.sh deploy    # scp package + qr/ to stw-teachings/rejoicing, add .htaccess rewrite (idempotent)
./sunday-buildout.sh verify    # curl every live URL, cache-busted
./sunday-buildout.sh commit    # git add/commit/push + tag rejoicing-sunday-2026-09-13
```

WordPress edits done by hand this week (backups `*.bak-rejoicing` on the server):
`header.php` THIS WEEK link (desktop + mobile) · `page-teachings.php` featured + recent card ·
`public_html/index.html` `STW_CURRENT_PACKAGE`. Git: commit `fe10dcd`, tag `rejoicing-sunday-2026-09-13`.

---

## (D) Build Status Table — updated 2026-09-13

| Deliverable | Status |
|---|---|
| Teaching outline (3 steps, scripture-checked) | ✅ Built (script `.md` not on this Mac — see E) |
| Vertical (9:16) teaching script | ✅ Built (same file) |
| PPTX slide decks | ✅ `slides/` — 18-slide "The Reset" (as taught) + 27-slide |
| Mobile teaching HTML page | ✅ Live — `index.html` (generated) |
| Interactive quiz (HTML) | ✅ Live — `quiz.html`, 8 questions |
| Bingo card | ✅ Live — `bingo.html` |
| Prayer card | ✅ Live — `prayer.html` (topic `rejoicing`, gospel section) |
| QR code set | ✅ Live — `qr-codes.html` + `qr/*.png|svg` (7 codes) |
| Kids version (bingo/quiz/activity) | ✅ Live — `kids-quiz.html`, `kids-bingo.html`, `kids-activity.html` |
| Kids teacher guide + kids song | ✅ `kids-teacher-guide.md`, `kids-worship-song.md` |
| The Joy Trail (kids story + Psalm 65:12 verse trainer + quiz) | ✅ Live — `kids/index.html` (from `PUSH_joy-trail_2026-09-13.md`) |
| Site set to THIS WEEK | ✅ nav, /teachings/ featured, homepage band |
| Notion session log archived | ✅ [Session Log — StayTheWay Rejoicing on Every Side (2026.09.13)](https://app.notion.com/p/3da7fe8317af81da9190f146c4292289) |

---

## (E) Next Actions

- Flush SiteGround Dynamic Cache (Site Tools → Speed → Caching) so the homepage band shows Rejoicing to visitors.
- Paste the block in `youtube-description.md` into both YouTube cuts.
- Save `Sunday-Reset-Rejoicing-on-Every-Side.md` into this folder if it exists elsewhere.
- Once YouTube generates a maxres thumbnail, rerun `probe_thumbs.py` + `gen.py` and redeploy `index.html`.
