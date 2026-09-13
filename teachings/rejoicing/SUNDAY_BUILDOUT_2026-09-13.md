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

Run from `~/StayTheWay/teachings/rejoicing/` on the Mac (`$HOME=/Users/jcwa1`):

```bash
# 1. Confirm deliverables are all present
ls -la ~/StayTheWay/teachings/rejoicing/

# 2. If deploying the finished HTML page(s) to the live site (SiteGround/WordPress path)
scp ~/StayTheWay/teachings/rejoicing/*.html <SITEGROUND_USER>@<SITEGROUND_HOST>:~/public_html/teachings/rejoicing/
# then flush LiteSpeed cache from wp-admin (or your usual cache-purge command)

# 3. If deploying via the GitHub Pages teaching hub instead
cd ~/StayTheWay
git add teachings/rejoicing/
git commit -m "Add Rejoicing on Every Side teaching (Psalm 65 / Proverbs 13)"
git push origin main

# 4. Tag today's build (matches the romans-8-sunday-YYYY-MM-DD pattern)
git tag rejoicing-sunday-2026-09-13
git push origin rejoicing-sunday-2026-09-13
```

`<SITEGROUND_USER>` / `<SITEGROUND_HOST>` are placeholders — swap in your real SSH credentials before running. Say the word and I'll also write a `sunday-buildout.sh` helper (status / deploy / commit / all subcommands) matching the one built for the Romans 8 buildout, once the HTML deliverables below exist to check against.

---

## (D) Build Status Table

| Deliverable | Status |
|---|---|
| Teaching outline (3 steps, scripture-checked) | ✅ Built |
| Vertical (9:16) teaching script | ✅ Built |
| PPTX slide deck (27 slides, camera-safe) | ✅ Built |
| Mobile teaching HTML page | ⬜ Not started |
| Interactive quiz (HTML) | ⬜ Not started |
| Bingo card | ⬜ Not started |
| Prayer card | ⬜ Not started |
| QR code set | ⬜ Not started |
| Kids version (bingo/quiz/activity) | ⬜ Not started |
| Notion session log archived | ⬜ Not started |

---

## (E) Next Actions

- Decide whether this Sunday's package needs the full 10-deliverable treatment (like Romans 7–8 and Be Still) or just the teaching + deck.
- If the full package: build the HTML teaching page, quiz, bingo, prayer card, and QR set next.
- Fill in real SiteGround/GitHub deploy details above once ready to push live.
- After deploy, log this session to Notion under MASTER EXECUTION HUB (Session Log — StayTheWay Rejoicing on Every Side, 2026.09.13) for continuity.
