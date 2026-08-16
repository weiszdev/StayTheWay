import json, io, urllib.request
VIDS = ["WJSYGNo8PsI","Z1HXjCnIHME","Gc9voD8b5Kc","Dalvq22ne-A","-wlqh0TACQE",
        "TYA7QJhNuPM","PIEFRG69j0o","K27KAOfVxsw","T1SUiAvmEjE","XuLetJBP554","AH59MP-kHzE"]
def ok(url):
    try:
        req=urllib.request.Request(url, headers={"User-Agent":"Mozilla/5.0"})
        r=urllib.request.urlopen(req, timeout=15)
        return r.status==200 and len(r.read())>8000     # placeholder is ~1KB
    except Exception:
        return False
best={}
for v in VIDS:
    for kind in ("maxresdefault","sddefault","hqdefault"):
        u=f"https://i.ytimg.com/vi/{v}/{kind}.jpg"
        if ok(u):
            best[v]=kind; print(f"{v:14} -> {kind}"); break
    else:
        best[v]="hqdefault"; print(f"{v:14} -> hqdefault (unverified)")
io.open("/private/tmp/claude-501/-Users-jcwa1/f0360b7c-f453-4538-8d2b-3ee07808705c/scratchpad/build/thumbs.json","w").write(json.dumps(best,indent=1))
