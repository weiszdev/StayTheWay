# TERMINAL PUSH — The Joy Trail (Kids)
**Teaching:** Rejoicing on Every Side (Psalm 65:11–13 · Proverbs 13:1)
**Slug:** `rejoicing`
**File:** `joy-trail.html` — interactive kids page (Story walk-through, Psalm 65:12 memory-verse trainer, quiz)
**Target path:** `staytheway.com/teachings/rejoicing/kids/`

Run from `~/StayTheWay/` on the Mac (`$HOME=/Users/jcwa1`).

---

## 1. Put the file in place

```bash
mkdir -p ~/StayTheWay/teachings/rejoicing/kids
# Move the downloaded file into place as index.html for a clean URL:
mv ~/Downloads/joy-trail.html ~/StayTheWay/teachings/rejoicing/kids/index.html
```

If you already saved it somewhere other than `~/Downloads`, swap that path in the `mv` above.

## 2. Sanity-check it locally before pushing

```bash
open ~/StayTheWay/teachings/rejoicing/kids/index.html
```

Walk all three stops (Story → Verse → Play) once — confirm the word-scramble finale and the quiz finish screen both render.

## 3. Push — pick whichever is your live path for this teaching

**A) GitHub Pages (weiszdev/StayTheWay teaching hub)** — this is the current standalone architecture for interactive tools/quizzes:

```bash
cd ~/StayTheWay
git add teachings/rejoicing/kids/index.html
git commit -m "Add Joy Trail — kids interactive companion for Rejoicing on Every Side"
git push origin main
```

Live at: `https://weiszdev.github.io/StayTheWay/teachings/rejoicing/kids/`

**B) SiteGround / WordPress (legacy staytheway.com path)** — if this teaching's page is still served from the WordPress host instead:

```bash
scp ~/StayTheWay/teachings/rejoicing/kids/index.html \
  <SITEGROUND_USER>@<SITEGROUND_HOST>:~/public_html/teachings/rejoicing/kids/index.html
```

Then flush the LiteSpeed cache from wp-admin (or your usual cache-purge command) so the new page isn't served stale.

`<SITEGROUND_USER>` / `<SITEGROUND_HOST>` are placeholders — swap in your real SSH credentials.

## 4. Tag today's build

If you haven't already tagged this Sunday's build:

```bash
git tag rejoicing-sunday-2026-09-13
git push origin rejoicing-sunday-2026-09-13
```

If the tag already exists from pushing the teaching page/deck earlier today, no need to re-tag — this commit just rides along inside it.

## 5. Confirm live

```bash
curl -sI https://weiszdev.github.io/StayTheWay/teachings/rejoicing/kids/ | head -1
# or, if deployed via SiteGround:
curl -sI https://staytheway.com/teachings/rejoicing/kids/ | head -1
```

Look for `HTTP/2 200`.

---

**Note:** the file only needs to be edited in place if you tweak wording later — it's fully self-contained (no build step, no external JS beyond Google Fonts). Re-run step 3 after any edit.
