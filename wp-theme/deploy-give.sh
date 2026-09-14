#!/usr/bin/env bash
# Give page: Zeffy -> Givebutter + PayPal / Venmo / Cash App.
#   1. Fill in wp-theme/give-config.php (embed code, links, handles)
#   2. wp-theme/deploy-give.sh check    # lint + show which options are filled in
#   3. wp-theme/deploy-give.sh deploy   # back up, upload atomically, flush WP object cache
#   4. wp-theme/deploy-give.sh verify   # live page: 200, no Zeffy, configured links present
set -euo pipefail

HERE="$(cd "$(dirname "$0")" && pwd)"
KEY="$HOME/.ssh/siteground_stw"; PORT=18765; U="u2121-p9x72lgphszm@ssh.staytheway.com"
DOC=/home/customer/www/staytheway.com/public_html
TH=$DOC/wp-content/themes/staytheway
rsh() { ssh -i "$KEY" -p "$PORT" -o ConnectTimeout=20 "$U" "$@"; }
up()  { scp -q -i "$KEY" -P "$PORT" "$1" "$U:$2"; }

cmd_check() {
  up "$HERE/page-give.php"   /tmp/stw-page-give.php
  up "$HERE/give-config.php" /tmp/stw-give-config.php
  up "$HERE/functions.php"   /tmp/stw-functions.php
  rsh "php -l /tmp/stw-page-give.php && php -l /tmp/stw-give-config.php && php -l /tmp/stw-functions.php && php -r '
    \$c = include \"/tmp/stw-give-config.php\";
    foreach (\$c as \$k => \$v) printf(\"  %-18s %s\n\", \$k, trim((string)\$v) === \"\" ? \"(blank - hidden)\" : \"set\");'"
}

cmd_deploy() {
  cmd_check
  echo "== guard: live functions.php / main.css unchanged since these edits were made"
  local live_f live_c
  live_f=$(rsh "md5sum $TH/functions.php | cut -c1-32")
  live_c=$(rsh "md5sum $TH/assets/css/main.css | cut -c1-32")
  if [ "$live_f" != "$(cat "$HERE/.base/functions.php.md5")" ] || [ "$live_c" != "$(cat "$HERE/.base/main.css.md5")" ]; then
    echo "!! A live theme file changed since the Givebutter edits were prepared. Re-pull and re-apply before deploying."; exit 1
  fi
  up "$HERE/page-give.php"        "$TH/page-give.php.new"
  up "$HERE/give-config.php"      "$TH/give-config.php.new"
  up "$HERE/functions.php"        "$TH/functions.php.new"
  up "$HERE/assets/css/main.css"  "$TH/assets/css/main.css.new"
  rsh "set -e; cd $TH
    for f in page-give.php give-config.php functions.php; do php -l \$f.new >/dev/null; done
    for f in page-give.php functions.php assets/css/main.css; do [ -f \$f.bak-givebutter ] || cp -p \$f \$f.bak-givebutter; done
    mv -f give-config.php.new give-config.php
    mv -f page-give.php.new page-give.php
    mv -f assets/css/main.css.new assets/css/main.css
    mv -f functions.php.new functions.php
    wp cache flush --path=$DOC >/dev/null && echo '  deployed; backups: *.bak-givebutter'"
  echo "NOTE: flush SiteGround Dynamic Cache (Site Tools -> Speed -> Caching) so visitors see the new page."
}

cmd_verify() {
  local out=/tmp/stw-give-verify.html code
  code=$(curl -s -o "$out" -w "%{http_code}" "https://staytheway.com/give/?cb=$(date +%s)")
  echo "  /give/ -> $code"
  printf "  zeffy mentions: %s\n" "$(grep -c -i zeffy "$out" || true)"
  printf "  dead '#' give buttons: %s\n" "$(grep -c 'href="#" class="btn' "$out" || true)"
  for k in givebutter paypal venmo.com cash.app; do printf "  %-11s %s\n" "$k" "$(grep -c -i "$k" "$out" || true)"; done
  [ "$code" = 200 ]
}

case "${1:-check}" in
  check) cmd_check ;; deploy) cmd_deploy ;; verify) cmd_verify ;;
  *) echo "Usage: $0 {check|deploy|verify}"; exit 1 ;;
esac
