# Stay The Way — Applied vs. Nothing (7 IDs of a Fake Christian)

**Slug:** `7-fake-christians`
**Live target:** `https://staytheway.com/teachings/7-fake-christians/`

## Files in this folder

- `bingo.html` — 5×5 Bible Bingo (24 terms + AMEN free center)
- `quiz.html` — 8-question interactive quiz
- `prayer.html` — Prayer request form (double opt-in via Apps Script)
- `README.md` — this file

## Deployment (must match QR codes)

The slide deck (`7_Fake_Christians_VERTICAL_v1_CAMERA_FULL916_QR.pptx`) bakes these exact URLs into its QR codes — **do not change folder name** without regenerating the deck:

- `https://staytheway.com/teachings/7-fake-christians/bingo.html`
- `https://staytheway.com/teachings/7-fake-christians/prayer.html`
- `https://staytheway.com/teachings/7-fake-christians/quiz.html`

## Apps Script backend

Reuses the existing Web App URL from a prior teaching (e.g. `7-pillars-woman/prayer.html` or `7-women-god-met/prayer.html`). The `prayer.html` form posts a hidden `topic=7-fake-christians` field so submissions land in the same Sheet under this teaching's topic value.

**One-time edit required:** Open `prayer.html` and replace the placeholder `APPS_SCRIPT_URL` constant near the bottom of the `<script>` block with the live Web App URL (or run `deploy_today.sh` which patches it automatically).

## Quick deploy

From the project root on your Mac:

```bash
bash deploy_today.sh
```

The script auto-discovers the local StayTheWay repo, pulls the existing Apps Script URL from last week's `prayer.html`, copies these four files into `teachings/7-fake-christians/`, patches `prayer.html`, and pauses for the upload step.
