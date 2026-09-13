#!/usr/bin/env python3
"""Run ON the server after enabling the share-card rewrite.
For every teaching page: served body == file (ignoring share tags), og:image -> card, card is a 1200x630 JPEG."""
import os, re, subprocess, sys, struct
ROOT = "/home/customer/www/staytheway.com/public_html/stw-teachings"
SITE = "https://staytheway.com"
SHARE = re.compile(r'[ \t]*<meta\s+[^>]*(?:property|name)=["\'](?:og:image(?::[a-z_]+)?|twitter:image(?::[a-z_]+)?|twitter:card)["\'][^>]*>[ \t]*\r?\n?', re.I)
BLOCK = re.compile(r'<!-- share card: /stw-teachings/_og/ -->\n.*?(?=</head>)', re.S | re.I)

def get(url):
    r = subprocess.run(["curl", "-s", "-o", "/tmp/_og_body", "-w", "%{http_code}|%{content_type}", url], capture_output=True, text=True)
    code, ctype = r.stdout.split("|", 1)
    return int(code), ctype, open("/tmp/_og_body", "rb").read()

def jpeg_size(b):
    i = 2
    while i < len(b):
        if b[i] != 0xFF: i += 1; continue
        m = b[i+1]
        if m in (0xC0, 0xC1, 0xC2):
            h, w = struct.unpack(">HH", b[i+5:i+9]); return w, h
        i += 2 + struct.unpack(">H", b[i+2:i+4])[0]
    return None

pages = sorted(os.path.relpath(os.path.join(d, f), ROOT) for d, _, fs in os.walk(ROOT) if "/_og" not in d + "/" for f in fs if f.endswith(".html"))
pkgs_with_pretty = set(re.findall(r"\^teachings/([^/]+)/\$", open(ROOT + "/../.htaccess").read()))
fail = 0
cards = set()
for rel in pages:
    body_file = open(os.path.join(ROOT, rel), "rb").read().decode("utf-8", "replace")
    # Public URLs only: SiteGround's nginx serves files that exist under /stw-teachings/ straight from disk,
    # so the card rewrite only runs on the /teachings/ URLs people actually share.
    pkg = rel.split("/")[0]
    if pkg not in pkgs_with_pretty:
        print("SKIP (no public URL)", rel); continue
    urls = [f"{SITE}/teachings/{pkg}/" if rel == f"{pkg}/index.html" else f"{SITE}/teachings/{rel}"]
    for url in urls:
        code, ctype, raw = get(url)
        served = raw.decode("utf-8", "replace")
        probs = []
        if code != 200: probs.append(f"status {code}")
        if "charset=utf-8" not in ctype.lower(): probs.append(f"ctype {ctype}")
        m = re.search(r'<meta property="og:image" content="([^"]+)"', served)
        if not m or "/_og/card/" not in m.group(1): probs.append("og:image not a card")
        else: cards.add(m.group(1).replace("&amp;", "&"))
        a = SHARE.sub("", body_file)
        b = SHARE.sub("", BLOCK.sub("", served))
        # page.php may add og:title/type/site_name/url when a page lacks them
        b = re.sub(r'<meta property="og:(?:title|type|site_name|url)" content="[^"]*" />\n', "", b) if 'og:title' not in body_file else b
        if a != b: probs.append("body differs")
        if probs:
            fail += 1; print("FAIL", url, "; ".join(probs))
for c in sorted(cards):
    code, ctype, raw = get(c)
    if code != 200 or ctype != "image/jpeg" or jpeg_size(raw) != (1200, 630):
        fail += 1; print("FAIL card", c, code, ctype, jpeg_size(raw))
print(f"pages={len(pages)} cards={len(cards)} failures={fail}")
sys.exit(1 if fail else 0)
