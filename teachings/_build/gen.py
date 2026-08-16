#!/usr/bin/env python3
"""
StayTheWay — teaching landing page generator.

Reads the live pages (scratchpad/live/<slug>/index.html), pulls their content,
and regenerates each index.html against the shared design system at
/stw-teachings/assets/stw-teaching.css.

Run:  python3 gen.py        -> writes scratchpad/build/out/<slug>/index.html
"""
import io, os, re, json, html

THUMBS = json.load(io.open(os.path.join(os.path.dirname(os.path.abspath(__file__)),"thumbs.json"),encoding="utf-8"))

HERE   = os.path.dirname(os.path.abspath(__file__))
SCRATCH= os.path.dirname(HERE)
LIVE   = os.path.join(SCRATCH, "live")
OUT    = os.path.join(HERE, "out")

CSS_URL   = "https://staytheway.com/stw-teachings/assets/stw-teaching.css"
OG_IMAGE  = ("https://res.cloudinary.com/dyq7rnjjw/image/upload/"
             "c_fill,w_1200,h_630,g_center,q_auto,f_jpg/v1775094378/IMG_2196_waiddo.png")
PODCAST   = "https://podcasts.apple.com/us/podcast/stay-the-way/id1187607030"
CHANNEL   = "https://www.youtube.com/@weStayTheWay"

# --------------------------------------------------------------------------
# Per-package overrides. video: "" means no video on file -> branded fallback.
# --------------------------------------------------------------------------
PKG = {
  "hebrews-4":               {"video":"WJSYGNo8PsI", "date":"Aug 16, 2026", "base":""},
  "7-marriages-god-blessed": {"video":"Z1HXjCnIHME", "date":"Jul 5, 2026",  "base":""},
  "7-pillars-disobedience":  {"video":"",            "date":"Jun 2026",     "base":""},
  "pulling-it-together":     {"video":"Gc9voD8b5Kc", "date":"Jun 8, 2026",  "base":""},
  "be-still":                {"video":"Dalvq22ne-A", "date":"Jun 1, 2026",  "base":""},
  "fruit-or-flesh":          {"video":"-wlqh0TACQE", "date":"May 24, 2026", "base":"interactive/"},
  "romans-8":                {"video":"TYA7QJhNuPM", "date":"May 18, 2026", "base":""},
  "romans-7":                {"video":"",            "date":"May 2026",     "base":""},
  "psalm-40":                {"video":"PIEFRG69j0o", "date":"May 14, 2026", "base":""},
  "7-fake-christians":       {"video":"K27KAOfVxsw", "date":"May 3, 2026",  "base":""},
  "7-women-god-met":         {"video":"T1SUiAvmEjE", "date":"Apr 26, 2026", "base":""},
  "7-pillars-woman":         {"video":"XuLetJBP554", "date":"Apr 19, 2026", "base":""},
  "7-pillars-man":           {"video":"AH59MP-kHzE", "date":"Apr 14, 2026", "base":""},
  "philemon":                {"video":"",            "date":"Jun 2026",     "base":""},
  "walking-by-the-spirit":   {"video":"",            "date":"7-Week Series","base":""},
}

# Resource catalogue: filename -> (icon, title, blurb, variant)
RES = {
  "bingo.html":        ("\U0001F3AF", "Bible Bingo",    "Play along live — mark a square every time you hear the word.", ""),
  "quiz.html":         ("\U0001F4D6", "Teaching Quiz",  "See what stuck. Instant feedback on every answer and a final score.", ""),
  "prayer.html":       ("\U0001F64F", "Prayer Request", "Confidential, straight to the prayer team. Double opt-in verification.", ""),
  "kids-quiz.html":    ("⭐",      "Kids Quiz",      "Swipe to answer — fun true-or-false questions for ages 5–10.", "kids"),
  "kids.html":         ("⭐",      "Kids Quiz",      "Swipe to answer — fun true-or-false questions for ages 5–10.", "kids"),
  "kids-bingo.html":   ("\U0001F3B2", "Kids Bingo",     "A 4×4 emoji board with big buttons made for little hands.", "kids"),
  "kids-activity.html":("\U0001F3A8", "Kids Activity",  "Finger-paint the scenes, trace the verse, draw a prayer.", "kids"),
  "coloring.html":     ("\U0001F3A8", "Coloring Page",  "Color the scene on screen, then print it out.", "kids"),
  "kids-game.html":    ("\U0001F579", "Kids Game",      "One more game to play along with the teaching.", "kids"),
}
ORDER   = ["bingo.html","quiz.html","prayer.html"]
K_ORDER = ["kids-quiz.html","kids.html","kids-bingo.html","kids-activity.html","coloring.html","kids-game.html"]
SKIP    = {"index.html","verified.html","qr-codes.html"}

ENT = [("&mdash;","—"),("&ndash;","–"),("&amp;","&"),("&ldquo;","“"),("&rdquo;","”"),
       ("&lsquo;","‘"),("&rsquo;","’"),("&hellip;","…"),("&bull;","•"),
       ("&times;","×"),("&nbsp;"," "),("&larr;",""),("&rarr;",""),("&laquo;",""),("&raquo;","")]

def unent(x):
    for a,b in ENT: x = x.replace(a,b)
    return x
def strip(x):
    return re.sub(r"\s+"," ", unent(re.sub(r"<[^>]+>","",x))).strip()
def esc(x):
    return html.escape(x, quote=True)

def read_live(slug):
    p = os.path.join(LIVE, slug, "index.html")
    return io.open(p, encoding="utf-8", errors="replace").read() if os.path.isfile(p) else ""

def parse(slug, src):
    d = {}
    m = re.search(r"<h1[^>]*>(.*?)</h1>", src, re.S);          d["title"] = strip(m.group(1)) if m else slug
    m = re.search(r'class="sub"[^>]*>(.*?)</div>', src, re.S);  d["sub"]   = strip(m.group(1)) if m else ""
    m = re.search(r'class="(?:verse-banner|verse-card)"[^>]*>(.*?)</div>', src, re.S)
    if m:
        blk = m.group(1)
        r = re.search(r'class="ref"[^>]*>(.*?)</span>', blk, re.S)
        d["ref"]   = strip(r.group(1)) if r else ""
        d["verse"] = strip(re.sub(r'<span class="ref".*?</span>', "", blk, flags=re.S))
    else:
        d["verse"] = d["ref"] = ""
    m = re.search(r'<meta property="og:description" content="([^"]*)"', src)
    d["ogdesc"] = strip(m.group(1)) if m else ""
    return d

def carried(src):
    """Preserve non-resource sections (series arcs, lists, challenges)."""
    out = []
    parts = re.split(r'<div class="section-label"[^>]*>(.*?)</div>', src, flags=re.S)
    for i in range(1, len(parts), 2):
        label = strip(parts[i]); body = parts[i+1] if i+1 < len(parts) else ""
        low = label.lower()
        if any(k in low for k in ("resource","kids activit","kids")):     # rebuilt below
            continue
        body = body.split("<footer")[0]
        body = re.sub(r'<div class="cards">.*?</div>\s*(?=<|$)', "", body, flags=re.S)
        keep = []
        for p in re.findall(r'<p class="arc-text">(.*?)</p>', body, re.S):
            keep.append('<p class="arc-text">%s</p>' % p.strip())
        for lst in re.findall(r'<(?:ol|ul)[^>]*>(.*?)</(?:ol|ul)>', body, re.S):
            items = re.findall(r"<li[^>]*>(.*?)</li>", lst, re.S)
            if items:
                keep.append('<ol class="stw-list">' + "".join('<li>%s</li>' % it.strip() for it in items) + '</ol>')
        if keep:
            out.append((label, "\n      ".join(keep)))
    return out

def card(href, icon, title, desc, variant=""):
    cls = "rcard" + (" " + variant if variant else "")
    return f"""      <a href="{href}" class="{cls}">
        <div class="ico">{icon}</div>
        <div class="rtitle">{esc(title)}</div>
        <div class="rdesc">{esc(desc)}</div>
        <div class="go">Open <i>&rarr;</i></div>
      </a>"""


def series_cards(src):
    """Series hubs (walking-by-the-spirit, pulling-it-together) carry week-card /
    res-card anchors that the generic parser would drop. Convert them to .rcard."""
    weeks, extras, more = [], [], []
    for m in re.finditer(r'<a href="([^"]+)"[^>]*class="week-card[^"]*"[^>]*>(.*?)</a>', src, re.S):
        href, body = m.group(1), m.group(2)
        n  = re.search(r'class="week-num"[^>]*>(.*?)</div>', body, re.S)
        h  = re.search(r"<h3[^>]*>(.*?)</h3>", body, re.S)
        vr = re.search(r'class="verse-ref"[^>]*>(.*?)</div>', body, re.S)
        pp = re.search(r"<p[^>]*>(.*?)</p>", body, re.S)
        title = strip(h.group(1)) if h else "Teaching"
        if n: title = f"Week {strip(n.group(1))} \u00b7 {title}"
        desc = strip(pp.group(1)) if pp else (strip(vr.group(1)) if vr else "")
        weeks.append(card(href, "\U0001F4DA", title, desc[:150]))
    for m in re.finditer(r'<a href="([^"]+)"[^>]*class="res-card"[^>]*>(.*?)</a>', src, re.S):
        href, body = m.group(1), m.group(2)
        ic = re.search(r'class="res-icon"[^>]*>(.*?)</span>', body, re.S)
        h  = re.search(r"<h4[^>]*>(.*?)</h4>", body, re.S)
        pp = re.search(r"<p[^>]*>(.*?)</p>", body, re.S)
        t  = strip(h.group(1)) if h else "Resource"
        if any(k in t.lower() for k in ("youtube","podcast")):   # already in Listen row
            continue
        more.append(card(href, strip(ic.group(1)) if ic else "\U0001F517",
                         t, strip(pp.group(1)) if pp else "", ""))
    for m in re.finditer(r'<a href="(/teachings/[^"]+)"[^>]*class="(?:series-link|series-home|prev|next)"[^>]*>(.*?)</a>', src, re.S):
        href = m.group(1); t = strip(m.group(2)).strip(" \u2190\u2192").strip()
        t = re.sub(r"^(Week\s+\d+)\s+", "\\1 \u00b7 ", t)
        extras.append(card(href, "\U0001F9ED", t or "Series", "Jump to this teaching in the series.", ""))
    return weeks, extras, more

def build(slug, files):
    src  = read_live(slug)
    meta = parse(slug, src)
    cfg  = PKG.get(slug, {"video":"", "date":"", "base":""})
    base = cfg["base"]; vid = cfg["video"]; date = cfg["date"]

    title, sub = meta["title"], meta["sub"]
    desc = meta["ogdesc"] or f"Interactive teaching resources for {title} from StayTheWay Ministry."

    # ---- hero ----
    if vid:
        kind  = THUMBS.get(vid, "sddefault")            # server-verified: 404 placeholders excluded
        thumb = f"https://i.ytimg.com/vi/{vid}/{kind}.jpg"
        fallb = f"https://i.ytimg.com/vi/{vid}/sddefault.jpg"
        fallb2 = f"https://i.ytimg.com/vi/{vid}/hqdefault.jpg"
        hero = f"""  <a class="hero reveal" href="https://www.youtube.com/watch?v={vid}" target="_blank" rel="noopener" aria-label="Watch the teaching on YouTube">
    <img src="{thumb}" alt="{esc(title)} — watch the teaching" loading="lazy"
         onload="if(this.naturalWidth<=120){{if(!this.dataset.f){{this.dataset.f=1;this.src='{fallb}';}}else if(this.dataset.f=='1'){{this.dataset.f=2;this.src='{fallb2}';}}else{{this.closest('.hero').classList.add('novid');this.remove();}}}}"
         onerror="if(!this.dataset.f){{this.dataset.f=1;this.src='{fallb}';}}else if(this.dataset.f=='1'){{this.dataset.f=2;this.src='{fallb2}';}}" />
    <div class="scrim"></div>
    <div class="play"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg></div>
    <div class="meta">
      <div class="eyebrow">&#9654; Watch the teaching{(" &middot; " + esc(date)) if date else ""}</div>
    </div>
  </a>
  <p class="hero-note">Prefer to listen? <a href="{PODCAST}" target="_blank" rel="noopener">Stay The Way on Apple Podcasts &rarr;</a></p>"""
    else:
        hero = f"""  <a class="hero novid reveal" href="{CHANNEL}" target="_blank" rel="noopener" aria-label="Watch on the StayTheWay YouTube channel">
    <div class="fallback">
      <div class="mark">&#9654;&#65039;</div>
      <div class="txt">Watch this teaching on the StayTheWay YouTube channel.</div>
    </div>
    <div class="meta">
      <div class="eyebrow">&#9654; Watch on YouTube</div>
    </div>
  </a>
  <p class="hero-note">Prefer to listen? <a href="{PODCAST}" target="_blank" rel="noopener">Stay The Way on Apple Podcasts &rarr;</a></p>"""

    # ---- verse ----
    verse = ""
    if meta["verse"]:
        verse = f"""  <div class="verse reveal">
    {esc(meta['verse'])}
    <span class="ref">{esc(meta['ref'])}</span>
  </div>"""

    # ---- resource cards ----
    have = {f for f in files if f not in SKIP}
    main = [card(base+f, *RES[f]) for f in ORDER if f in have and f in RES]
    kids, seen = [], set()
    for f in K_ORDER:
        if f in have and f in RES:
            icon, t, dsc, var = RES[f]
            if t in seen: continue
            seen.add(t)
            kids.append(card(base+f, icon, t, dsc, var))

    sections = []
    if main:
        sections.append('  <div class="section-label reveal">Teaching Resources</div>\n'
                        '  <div class="cards reveal">\n' + "\n".join(main) + "\n  </div>")

    listen = [
      card(PODCAST, "\U0001F3A7", "Stay The Way Podcast",
           "Every teaching as audio — 500+ episodes on Apple Podcasts.", "listen"),
      card(CHANNEL, "\U0001F4FA", "YouTube Channel",
           "Watch live on Sundays and catch every past teaching.", "listen"),
    ]
    sections.append('  <div class="section-label reveal">Listen &amp; Watch Anywhere</div>\n'
                    '  <div class="cards reveal">\n' + "\n".join(listen) + "\n  </div>")

    if kids:
        sections.append('  <div class="section-label reveal">For the Kids</div>\n'
                        '  <div class="cards reveal">\n' + "\n".join(kids) + "\n  </div>")

    wk, ex, mo = series_cards(src)
    if wk:
        sections.append('  <div class="section-label reveal">In This Series</div>\n'
                        '  <div class="cards reveal">\n' + "\n".join(wk) + "\n  </div>")
    if ex:
        sections.append('  <div class="section-label reveal">Continue the Series</div>\n'
                        '  <div class="cards reveal">\n' + "\n".join(ex[:6]) + "\n  </div>")
    if mo:
        sections.append('  <div class="section-label reveal">More From StayTheWay</div>\n'
                        '  <div class="cards reveal">\n' + "\n".join(mo[:6]) + "\n  </div>")

    for label, body in carried(src):
        sections.append(f'  <div class="section-label reveal">{esc(label)}</div>\n'
                        f'  <div class="reveal">\n      {body}\n  </div>')

    page = f"""<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>{esc(title)} — StayTheWay Ministry</title>
<meta name="description" content="{esc(desc)}" />
<meta property="og:type" content="website" />
<meta property="og:title" content="{esc(title)} — StayTheWay Ministry" />
<meta property="og:description" content="{esc(desc)}" />
<meta property="og:image" content="{('https://i.ytimg.com/vi/'+vid+'/maxresdefault.jpg') if vid else OG_IMAGE}" />
<meta property="og:url" content="https://staytheway.com/teachings/{slug}/" />
<meta property="og:site_name" content="StayTheWay" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="{esc(title)} — StayTheWay Ministry" />
<meta name="twitter:description" content="{esc(desc)}" />
<meta name="twitter:image" content="{('https://i.ytimg.com/vi/'+vid+'/maxresdefault.jpg') if vid else OG_IMAGE}" />
<link rel="preconnect" href="https://i.ytimg.com" />
<link rel="stylesheet" href="{CSS_URL}" />
</head>
<body>

<div class="wrap">

  <div class="topbar">
    <a href="https://staytheway.com/teachings/">&larr; All Teachings</a>
    <span class="brand">STAYTHEWAY</span>
    <a href="https://staytheway.com/">Home</a>
  </div>

  <header class="stw">
    <div class="kicker">Teaching Package</div>
    <h1>{esc(title)}</h1>
    {f'<div class="sub">{esc(sub)}</div>' if sub else ''}
    <div class="rule"></div>
  </header>

{hero}

{verse}

{chr(10).join(sections)}

  <footer class="stw">
    <div class="flinks">
      <a href="https://staytheway.com/teachings/">All Teachings</a>
      <a href="{PODCAST}" target="_blank" rel="noopener">Podcast</a>
      <a href="{CHANNEL}" target="_blank" rel="noopener">YouTube</a>
      <a href="https://staytheway.com/resources/">Resources</a>
      <a href="https://staytheway.com/give/">Give</a>
    </div>
    <div><a href="https://staytheway.com" style="color:var(--sky);text-decoration:none;font-weight:700;">staytheway.com</a></div>
    <div class="ministry">StayTheWay Ministry &mdash; a 501(c)(3) service ministry</div>
  </footer>

</div>

<script>
(function () {{
  var els = document.querySelectorAll('.reveal');
  if (!('IntersectionObserver' in window)) {{
    els.forEach(function (e) {{ e.classList.add('visible'); }});
    return;
  }}
  var io = new IntersectionObserver(function (entries) {{
    entries.forEach(function (en) {{
      if (en.isIntersecting) {{ en.target.classList.add('visible'); io.unobserve(en.target); }}
    }});
  }}, {{ threshold: 0.08, rootMargin: '0px 0px -30px 0px' }});
  els.forEach(function (e) {{ io.observe(e); }});
}})();
</script>
</body>
</html>
"""
    return page


def main():
    manifest = {}
    for line in io.open(os.path.join(SCRATCH, "pkg_files.txt"), encoding="utf-8"):
        line = line.strip()
        if not line or "|" not in line: continue
        slug, files = line.split("|", 1)
        manifest[slug] = [f for f in files.split(",") if f]

    for slug, files in sorted(manifest.items()):
        d = os.path.join(OUT, slug); os.makedirs(d, exist_ok=True)
        page = build(slug, files)
        io.open(os.path.join(d, "index.html"), "w", encoding="utf-8").write(page)
        vid = PKG.get(slug, {}).get("video", "")
        print(f"  built {slug:26} video={vid or '(fallback)':13} cards={len([f for f in files if f not in SKIP])}")

if __name__ == "__main__":
    main()
