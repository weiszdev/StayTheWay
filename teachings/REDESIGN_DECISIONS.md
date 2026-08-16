# Teaching Page Redesign — Decisions Log

**Date:** 2026-08-16
**Trigger:** "flat look… should pull in my video thumbnail and give more flash to the links… make it flow together… link the podcast… landing page so the new content has attention."

---

## What changed

| Surface | Before | After |
|---|---|---|
| 13 teaching landing pages | Flat cards, inline CSS per page, no video | Cinematic video hero, dimensional cards, one shared stylesheet |
| Homepage | Latest video only; 5 dead nav links | "This Week" package band, podcast card, nav fixed |
| `/teachings/` | Text-only featured card | Featured card with thumbnail + play button, podcast strip |
| Podcast | Not linked anywhere except one hub page | Linked on all 13 pages, homepage, and `/teachings/` |

---

## Decisions

### 1. One shared stylesheet instead of per-page inline CSS
`/stw-teachings/assets/stw-teaching.css` is loaded by absolute URL from every teaching page.

**Why:** "Flow together" is impossible when 13 pages each carry their own copy of the CSS. One file means restyling all 13 is a single edit and a single upload.
**Trade-off:** One extra HTTP request per page, and pages no longer render standalone from `file://`. Worth it — these are only ever served from staytheway.com.
**Note:** The *interactive* pages (bingo, quiz, prayer, kids) still have inline CSS. Only the landing pages were converted. Converting the rest is a good follow-up.

### 2. Unified the accent color to brand blue
Every package now uses `#1E9BFF` / `#00BFFF`.

**Why:** Packages had drifted — `#1478F0` on most, `#D4A847` gold on 7 Marriages, `#2563eb` on Walking By the Spirit. Three different blues plus a gold read as three different websites.
**Trade-off:** 7 Marriages lost its distinct gold identity. Consistency won, since the ask was explicitly that they flow together. Per-package accents are still possible later via a single CSS variable override.
**Kept as accents:** yellow for kids resources, rose for listen/watch. These carry meaning, so they stayed.

### 3. Video thumbnails resolved server-side, not guessed in the browser
`_build/thumbs.json` records the highest resolution that actually exists per video.

**Why:** YouTube returns a **120×90 grey placeholder with a 404** for `maxresdefault.jpg` when there's no HD thumbnail. That placeholder *decodes as a valid image*, so `onerror` never fires and the hero silently renders an empty grey box. This bit 6 of the 11 videos.
**How:** `_build/probe_thumbs.py` checks each video (status 200 **and** body > 8 KB) and picks maxres → sd → hq. The page also carries an `onload` guard that swaps the source if `naturalWidth <= 120`, as a belt-and-braces fallback.

### 4. Pages are generated, not hand-edited
`_build/gen.py` reads the live pages, extracts their content, and re-emits them against the template.

**Why:** 13 pages hand-edited will drift again within a month. Regenerating is one command.
**Consequence:** Editing a landing page by hand will be overwritten on the next run. Change `gen.py` or the CSS instead.

### 5. Series hubs keep their unique content
`walking-by-the-spirit` and `pulling-it-together` are navigation hubs, not teaching landings. Their `week-card` and `res-card` blocks are converted into the new card style rather than dropped.

**Why:** A naive regeneration stripped the entire 8-week series index off `walking-by-the-spirit`. That was a regression, so the generator learned to carry those links across.

### 6. Hero overlay title removed
The hero shows only a "▶ Watch the teaching · date" badge, not the teaching title.

**Why:** YouTube thumbnails already have large baked-in title art. A second title overlaid on top collided with it and looked cluttered. The page `<h1>` sits directly above the hero anyway.

### 7. The homepage "This Week" band is data-driven
One object near the top of the homepage script:

```js
const STW_CURRENT_PACKAGE = { slug, kicker, title, desc, chips };
```

**Why:** The homepage is static HTML, but the featured package changes weekly. This makes the Sunday update a four-line edit in one obvious place instead of hunting through markup.
**Add to the weekly checklist:** update `STW_CURRENT_PACKAGE` when the new package deploys.

### 8. Fixed 5 broken nav links (pre-existing)
Every homepage nav pointed at `teachings.html`, `bridges.html`, `beliefs.html`, `community.html`, `give.html` — **all 404**. The real pages are WordPress slugs: `/teachings/`, `/bridges/`, `/beliefs/`, `/community/`, `/give/`. 20 hrefs rewritten.

**Why fixed here:** Driving attention to new content through a nav where 5 of 7 links are dead defeats the purpose. `resources.html` and `gifts/` were already fine and were left alone.

---

## Known gaps

- **3 packages have no video thumbnail** — `romans-7`, `philemon`, `walking-by-the-spirit`. No confident match in the 475-video channel catalogue. They show a branded fallback panel linking to the channel. Give me the video IDs and they're a one-line fix each in `gen.py`.
- **`7-marriages-god-blessed` video** — two candidates existed (Jul 5 and Jul 6). Used the Jul 5 Sunday teaching (`Z1HXjCnIHME`). Swap if wrong.
- **`be-still` had a broken placeholder** — its old page referenced the literal string `VIDEO_ID_HE`. Now points at `Dalvq22ne-A`.
- **`psalm-40` and `7-pillars-disobedience`** exist in the repo but were never deployed to SiteGround, so they were not redesigned.
- **Interactive pages still use inline CSS** — bingo/quiz/prayer/kids pages were not converted to the shared stylesheet.
- **SiteGround Dynamic Cache** (`x-proxy-cache-info: DT`) is not purgeable from the CLI because SG Optimizer is installed but inactive. WP-rendered pages (`/teachings/`, homepage) may serve stale for a while; the teaching pages themselves are static files and update immediately. Flush from Site Tools → Speed → Caching.

---

## Files

```
teachings/_assets/stw-teaching.css   the design system — edit this to restyle all 13
teachings/_build/gen.py              generator
teachings/_build/thumbs.json         verified thumbnail resolution per video
teachings/_build/probe_thumbs.py     re-probe thumbnails when videos are added
```

**Rollback:** every touched file on the server has a sibling `.bak-redesign`.
