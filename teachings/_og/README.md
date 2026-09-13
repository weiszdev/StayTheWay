# StayTheWay share cards — automatic link-preview images

Every teaching page on staytheway.com gets its own 1200×630 link-preview image (the picture
iMessage, Facebook, and Slack show when a link is shared). No step is needed per page or per week.

Built 2026-09-13. Lives on the server at `public_html/stw-teachings/_og/`; this folder is the
source of truth (`teachings/_og/` in the StayTheWay repo).

## How it works
1. `stw-teachings/.htaccess` routes every `*.html` (and folder `index.html`) through `_og/page.php`.
   The browser URL doesn't change.
2. `page.php` serves the file unchanged except for its share tags. It removes any `og:image`,
   `twitter:image`, and `twitter:card` tags and adds ones pointing at
   `/stw-teachings/_og/card/<page>.jpg?v=<hash>`.
3. `card.php` draws the card with PHP GD and caches it in `_og/cache/`:
   - **Headline:** the page's name from its `og:title` / `<title>`, e.g. "Bible Bingo" or "The Joy Trail".
     Landing pages use the package `<h1>`.
   - **Subline:** the package title, or the landing page's subtitle.
   - **Kicker:** PLAY ALONG LIVE, TEST YOURSELF, PRAY WITH US, TEACHING PACKAGE, or STAYTHEWAY KIDS.
     Kids pages use a yellow accent and a rounded font.
   - **Art:** `<package>/og-bg.jpg` if present. Otherwise the teaching's YouTube thumbnail, found from the
     landing page's video link (best available size, letterbox cropped, cached a week).
     Otherwise a brand glow.
4. A card re-renders automatically when the page, its landing page, or the art changes.

## Controls
- **Custom art for a package:** upload `stw-teachings/<slug>/og-bg.jpg`.
- **Keep a hand-made image on one page:** add `<meta name="stw-og" content="manual">` to that page.
- **Restyle every card:** edit `og_render()` in `lib.php`, bump `OG_VERSION`, upload.
- **Preview a card from SSH:** `php card.php rejoicing/bingo.html /tmp/bingo.jpg`

## Gotchas
- **Only the public `/teachings/...` URLs get cards.** SiteGround's nginx serves files that exist under
  `/stw-teachings/` straight from disk, so `.htaccess` never runs for those internal paths. That's fine,
  because every `og:url` and every shared link uses `/teachings/...`. Check with `curl -sI`: Apache responses
  carry `x-httpd: 1`.
- **Upload PHP atomically.** Every teaching page `require`s `lib.php`, so a half-copied file breaks pages
  for that instant. Copy to `lib.php.new`, run `php -l`, then `mv -f lib.php.new lib.php`.
- A new package needs nothing: its `/teachings/<slug>/` rewrite plus a YouTube link on its landing page is enough.

## Verify everything
`scp tools/regress.py` to the server and run `python3 regress.py`. It fetches every public teaching URL, checks
the body matches the file apart from share tags, and checks every card is a 1200×630 JPEG.
2026-09-13: `pages=88 cards=88 failures=0`.

## Rollback
Restore `stw-teachings/.htaccess` from `.htaccess.bak-og` (or delete the "share cards" block).
Pages then serve as plain static files again.

Fonts: Playfair Display, Inter, Baloo 2 — SIL Open Font License (`fonts/OFL-*.txt`).
