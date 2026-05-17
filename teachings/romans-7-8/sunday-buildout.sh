#!/usr/bin/env bash
# Romans 8 — Sunday Build-Out helper
# Pulled from Notion + local master prompt on 2026-05-17
# Run from ~/StayTheWay/teachings/romans-7-8/

set -euo pipefail

ROOT="$HOME/StayTheWay/teachings/romans-7-8"
SLUG="romans-8"
SSH_KEY="$HOME/.ssh/siteground_stw"
SSH_PORT=18765
SSH_USER="u2121-p9x72lgphszm"
SSH_HOST="ssh.staytheway.com"
REMOTE_DIR="/home/customer/www/staytheway.com/public_html/stw-teachings/${SLUG}/"

cmd_status() {
  echo "=== Build status — $(date '+%Y-%m-%d %H:%M:%S') ==="
  cd "$ROOT"
  for f in Romans_8_Teaching.pptx \
           ${SLUG}/index.html ${SLUG}/bingo.html ${SLUG}/quiz.html \
           ${SLUG}/prayer.html ${SLUG}/verified.html \
           ${SLUG}/kids-bingo.html ${SLUG}/kids-quiz.html ${SLUG}/kids-activity.html \
           teaching.html; do
    if [ -f "$f" ]; then
      printf "  [OK]   %s  (%s bytes)\n" "$f" "$(wc -c < "$f" | tr -d ' ')"
    else
      printf "  [MISS] %s\n" "$f"
    fi
  done
}

cmd_prompt() {
  echo "=== LOAD PROMPT — paste into Claude ==="
  awk '/^## B\./,/^---$/' "$ROOT/SUNDAY_BUILDOUT_2026-05-17.md"
}

cmd_deploy() {
  echo "=== Deploying ${SLUG}/ to SiteGround ==="
  cd "$ROOT/${SLUG}"
  ssh -i "$SSH_KEY" -p "$SSH_PORT" "${SSH_USER}@${SSH_HOST}" "mkdir -p ${REMOTE_DIR}"
  scp -i "$SSH_KEY" -P "$SSH_PORT" \
    index.html bingo.html quiz.html prayer.html verified.html \
    kids-bingo.html kids-quiz.html kids-activity.html \
    "${SSH_USER}@${SSH_HOST}:${REMOTE_DIR}"
  echo "=== Flushing LiteSpeed cache ==="
  ssh -i "$SSH_KEY" -p "$SSH_PORT" "${SSH_USER}@${SSH_HOST}" \
    "wp cache flush --path=/home/customer/www/staytheway.com/public_html && \
     wp litespeed-option set cache false --path=/home/customer/www/staytheway.com/public_html && \
     wp litespeed-option set cache true --path=/home/customer/www/staytheway.com/public_html"
}

cmd_commit() {
  cd "$HOME/StayTheWay"
  git add teachings/romans-7-8/
  git commit -m "Romans 8 teaching package — Sunday $(date +%Y-%m-%d) build" || true
  git push origin main
  git tag "romans-8-sunday-$(date +%Y-%m-%d)"
  git push --tags
}

case "${1:-status}" in
  status)  cmd_status ;;
  prompt)  cmd_prompt ;;
  deploy)  cmd_deploy ;;
  commit)  cmd_commit ;;
  all)     cmd_status && cmd_deploy && cmd_commit ;;
  *) echo "Usage: $0 {status|prompt|deploy|commit|all}" ; exit 1 ;;
esac
