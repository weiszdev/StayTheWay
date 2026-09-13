<?php
/**
 * StayTheWay share cards — shared helpers.
 *
 * Every teaching page under /stw-teachings/ is served through page.php, which points its
 * og:image / twitter:image at card.php. card.php draws a 1200x630 JPEG for that page from
 * the page's own title, its package landing page, and the teaching's YouTube art, and caches
 * it on disk. Nothing has to be done per page or per package. See README.md.
 */
declare(strict_types=1);

const OG_VERSION = 3;                    // bump to regenerate every cached card
const OG_SITE    = 'https://staytheway.com';
const OG_W       = 1200;
const OG_H       = 630;
const OG_PT      = 0.75;                 // GD FreeType renders at 96 dpi: px * 0.75 = pt

function og_root(): string
{
    return (string)realpath(dirname(__DIR__));          // .../public_html/stw-teachings
}

/** Map a request-relative path ("rejoicing/kids/", "hebrews-4/quiz.html") to a real page, or null. */
function og_resolve(string $rel): ?string
{
    $rel = ltrim(str_replace("\0", '', $rel), '/');
    if ($rel === '' || substr($rel, -1) === '/') {
        $rel .= 'index.html';
    }
    $root = og_root();
    $path = realpath($root . '/' . $rel);
    if ($path === false || strpos($path, $root . '/') !== 0 || strpos($path, $root . '/_og/') === 0) {
        return null;
    }
    return (is_file($path) && preg_match('/\.html?$/i', $path)) ? $path : null;
}

function og_rel(string $path): string
{
    return substr($path, strlen(og_root()) + 1);
}

function og_text(string $s): string
{
    $s = html_entity_decode(strip_tags($s), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $s = preg_replace('/[\x{1F000}-\x{1FFFF}\x{2600}-\x{27BF}\x{FE0F}\x{200D}]/u', '', $s);   // emoji: GD can't draw them
    return trim((string)preg_replace('/\s+/u', ' ', (string)$s));
}

function og_meta(string $html, string $key): string
{
    $k = preg_quote($key, '/');
    if (preg_match('/<meta\s+[^>]*(?:property|name)=["\']' . $k . '["\'][^>]*\scontent=(["\'])(.*?)\1/is', $html, $m)
        || preg_match('/<meta\s+[^>]*content=(["\'])(.*?)\1[^>]*\s(?:property|name)=["\']' . $k . '["\']/is', $html, $m)) {
        return og_text($m[2]);
    }
    return '';
}

/** Everything a card needs, derived from the page and its package landing page. */
function og_info(string $path): array
{
    $rel     = og_rel($path);
    $pkg     = explode('/', $rel)[0];
    $html    = (string)file_get_contents($path);
    $landingPath = og_root() . "/$pkg/index.html";
    $landing = is_file($landingPath) ? (string)file_get_contents($landingPath) : '';

    $pkgTitle = preg_match('/<h1[^>]*>(.*?)<\/h1>/is', $landing, $m) ? og_text($m[1]) : ucwords(str_replace('-', ' ', $pkg));
    $pkgSub   = preg_match('/class="sub"[^>]*>(.*?)<\/div>/is', $landing, $m) ? og_text($m[1]) : '';

    $raw = og_meta($html, 'og:title');
    if ($raw === '' && preg_match('/<title[^>]*>(.*?)<\/title>/is', $html, $m)) {
        $raw = og_text($m[1]);
    }
    $norm  = static fn(string $s): string => mb_strtolower((string)preg_replace('/[^\p{L}\p{N}]+/u', '', $s));
    $parts = array_values(array_filter(
        array_map('trim', preg_split('/\s+[—–|-]\s+/u', $raw) ?: []),
        static fn(string $p): bool => $p !== '' && !preg_match('/^stay\s*the\s*way/i', $p) && $norm($p) !== $norm($pkgTitle)
    ));

    $name      = strtolower((string)preg_replace('/\.html?$/i', '', basename($path)));
    $isLanding = ($rel === "$pkg/index.html");
    $isKids    = (bool)preg_match('#(^|/)(kids|coloring)#i', substr($rel, strlen($pkg)));

    if ($isLanding || !$parts) {
        $headline = $pkgTitle;
        $subline  = $isLanding ? $pkgSub : $pkgTitle;
    } else {
        $headline = $parts[0];
        $subline  = $pkgTitle;
    }

    $kickers = ['bingo' => 'PLAY ALONG LIVE', 'quiz' => 'TEST YOURSELF', 'prayer' => 'PRAY WITH US',
                'verified' => 'PRAYER CONFIRMED', 'qr-codes' => 'SCAN & SHARE'];
    if ($isLanding)       $kicker = 'TEACHING PACKAGE';
    elseif ($isKids)      $kicker = 'STAYTHEWAY KIDS';
    else                  $kicker = $kickers[$name] ?? 'STAYTHEWAY';

    $video = '';
    foreach ([$landing, $html] as $src) {
        if (preg_match('#(?:i\.ytimg\.com/vi/|youtube\.com/(?:watch\?v=|live/|embed/)|youtu\.be/)([A-Za-z0-9_-]{11})#', $src, $m)) {
            $video = $m[1];
            break;
        }
    }

    $bgFile = '';
    foreach (['og-bg.jpg', 'og-bg.png'] as $f) {
        if (is_file(og_root() . "/$pkg/$f")) { $bgFile = og_root() . "/$pkg/$f"; break; }
    }

    return [
        'rel' => $rel, 'pkg' => $pkg, 'headline' => $headline, 'subline' => $subline, 'kicker' => $kicker,
        'kids' => $isKids, 'video' => $video, 'bg_file' => $bgFile,
        'mtime' => (int)filemtime($path), 'landing_mtime' => $landing !== '' ? (int)filemtime($landingPath) : 0,
    ];
}

function og_cache_dir(): string
{
    $d = __DIR__ . '/cache';
    if (!is_dir($d)) {
        @mkdir($d, 0755, true);
    }
    return $d;
}

function og_http_get(string $url): ?string
{
    $ch = curl_init($url);
    curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_TIMEOUT => 8, CURLOPT_USERAGENT => 'StayTheWay-ShareCards/1.0']);
    $body = curl_exec($ch);
    $code = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return (is_string($body) && $code === 200) ? $body : null;
}

/** Best YouTube thumbnail for a video, cached a week. A missing maxres is a ~1KB grey 404 placeholder, so require > 8KB. */
function og_youtube_art(string $id): ?string
{
    $f = og_cache_dir() . "/yt-$id.jpg";
    if (is_file($f) && filemtime($f) > time() - 7 * 86400) {
        return $f;
    }
    foreach (['maxresdefault', 'sddefault', 'hqdefault'] as $kind) {
        $body = og_http_get("https://i.ytimg.com/vi/$id/$kind.jpg");
        if ($body !== null && strlen($body) > 8000) {
            file_put_contents($f, $body);
            return $f;
        }
    }
    return is_file($f) ? $f : null;
}

/** Path of the cached card for a page, rendering it first if needed. */
function og_card_file(string $path): string
{
    $info = og_info($path);
    $bg   = $info['bg_file'] !== '' ? $info['bg_file'] : ($info['video'] !== '' ? og_youtube_art($info['video']) : null);
    $key  = sha1(implode('|', [OG_VERSION, $info['rel'], $info['mtime'], $info['landing_mtime'],
                               $bg ? basename($bg) . '@' . filemtime($bg) : 'none']));
    // Art was expected but couldn't be fetched: don't cache, so the next request retries.
    $file = og_cache_dir() . "/card-$key" . (($info['video'] !== '' || $info['bg_file'] !== '') && !$bg ? '-noart' : '') . '.jpg';
    if (is_file($file) && strpos($file, '-noart') === false) {
        return $file;
    }
    $im  = og_render($info, $bg);
    $tmp = $file . '.' . getmypid() . '.tmp';
    imagejpeg($im, $tmp, 86);
    imagedestroy($im);
    rename($tmp, $file);
    return $file;
}

/* ------------------------------------------------------------------ drawing */

function og_font(string $name): string
{
    return __DIR__ . "/fonts/$name";
}

function og_color(GdImage $im, string $hex, int $alpha = 0): int
{
    [$r, $g, $b] = sscanf(ltrim($hex, '#'), '%02x%02x%02x');
    return imagecolorallocatealpha($im, $r, $g, $b, $alpha);
}

function og_width(string $font, float $px, string $text): int
{
    $b = imagettfbbox($px * OG_PT, 0, $font, $text);
    return (int)abs($b[2] - $b[0]);
}

function og_wrap(string $font, float $px, string $text, int $maxW): array
{
    $lines = [];
    $line  = '';
    foreach (preg_split('/\s+/u', trim($text)) ?: [] as $w) {
        $try = $line === '' ? $w : "$line $w";
        if ($line !== '' && og_width($font, $px, $try) > $maxW) {
            $lines[] = $line;
            $line = $w;
        } else {
            $line = $try;
        }
    }
    if ($line !== '') {
        $lines[] = $line;
    }
    return $lines;
}

/** Fit text preferring fewer lines: one line if it holds at a strong size, then two, then up to $maxLines. */
function og_fit(string $font, float $maxPx, float $minPx, string $text, int $maxW, int $maxLines): array
{
    for ($limit = 1; $limit <= $maxLines; $limit++) {
        $floor = $limit === $maxLines ? $minPx : max($minPx, $maxPx * ($limit === 1 ? 0.72 : 0.62));
        for ($px = $maxPx; $px >= $floor; $px -= 2) {
            $lines  = og_wrap($font, $px, $text, $maxW);
            $widest = $lines ? max(array_map(static fn($l) => og_width($font, $px, $l), $lines)) : 0;
            if (count($lines) <= $limit && $widest <= $maxW) {
                return [$px, $lines];
            }
        }
    }
    $lines = og_wrap($font, $minPx, $text, $maxW);
    if (count($lines) > $maxLines) {
        $lines = array_slice($lines, 0, $maxLines);
        $lines[$maxLines - 1] = rtrim($lines[$maxLines - 1], " ,.;:—-") . '…';
    }
    return [$minPx, $lines];
}

function og_tracked(GdImage $im, string $font, float $px, int $x, int $y, int $color, string $text, int $tracking): int
{
    foreach (preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY) ?: [] as $ch) {
        if ($ch === ' ') {
            $x += (int)round($px * 0.32) + $tracking;
            continue;
        }
        imagettftext($im, $px * OG_PT, 0, $x, $y, $color, $font, $ch);
        $x += og_width($font, $px, $ch) + $tracking;
    }
    return $x;
}

/** Decode art and center-crop it to 16:9 (YouTube sd/hq thumbnails are letterboxed 4:3). */
function og_load_art(?string $path): ?GdImage
{
    $src = $path ? @imagecreatefromstring((string)@file_get_contents($path)) : false;
    if (!$src) {
        return null;
    }
    $sw = imagesx($src);
    $sh = imagesy($src);
    $cw = $sw;
    $ch = (int)round($sw * 9 / 16);
    if ($ch > $sh) {
        $ch = $sh;
        $cw = (int)round($sh * 16 / 9);
    }
    $art = imagecreatetruecolor($cw, $ch);
    imagecopy($art, $src, 0, 0, (int)(($sw - $cw) / 2), (int)(($sh - $ch) / 2), $cw, $ch);
    imagedestroy($src);
    return $art;
}

function og_render(array $info, ?string $bgPath): GdImage
{
    $im = imagecreatetruecolor(OG_W, OG_H);
    imagealphablending($im, true);
    imagefilledrectangle($im, 0, 0, OG_W, OG_H, og_color($im, '#000014'));

    $accent = $info['kids'] ? '#FFD93D' : '#00BFFF';
    $rule   = $info['kids'] ? '#FFD93D' : '#1E9BFF';
    $art    = og_load_art($bgPath);

    if ($art) {
        // Soft full-bleed backdrop: blur a tiny copy, upscale bicubic, blur again. Darkened, then faded to navy on the left.
        $small = imagecreatetruecolor(64, 36);
        imagecopyresampled($small, $art, 0, 0, 0, 0, 64, 36, imagesx($art), imagesy($art));
        for ($i = 0; $i < 3; $i++) {
            imagefilter($small, IMG_FILTER_GAUSSIAN_BLUR);
        }
        $soft = imagescale($small, OG_W, (int)round(OG_W * 9 / 16), IMG_BICUBIC);
        imagedestroy($small);
        if ($soft) {
            for ($i = 0; $i < 2; $i++) {
                imagefilter($soft, IMG_FILTER_GAUSSIAN_BLUR);
            }
            imagecopy($im, $soft, 0, 0, 0, (int)((imagesy($soft) - OG_H) / 2), OG_W, OG_H);
            imagedestroy($soft);
        }
        imagefilledrectangle($im, 0, 0, OG_W, OG_H, og_color($im, '#000014', 38));
        for ($x = 0; $x < 760; $x++) {
            $alpha = $x < 420 ? 0 : (int)round(127 * ($x - 420) / 340);
            imageline($im, $x, 0, $x, OG_H, og_color($im, '#000014', $alpha));
        }

        // The teaching thumbnail itself, whole and framed.
        $tw = 500;
        $th = (int)round($tw * 9 / 16);
        $tx = OG_W - 64 - $tw;
        $ty = (int)round((OG_H - $th) / 2);
        for ($i = 24; $i > 0; $i -= 4) {
            imagefilledrectangle($im, $tx - $i + 10, $ty - $i + 16, $tx + $tw + $i + 10, $ty + $th + $i + 16, og_color($im, '#000000', 118));
        }
        imagefilledrectangle($im, $tx - 3, $ty - 3, $tx + $tw + 2, $ty + $th + 2, og_color($im, $rule));
        imagecopyresampled($im, $art, $tx, $ty, 0, 0, $tw, $th, imagesx($art), imagesy($art));
        imagedestroy($art);

        if ($info['kicker'] === 'TEACHING PACKAGE' && $info['video'] !== '') {
            $cx = $tx + (int)($tw / 2);
            $cy = $ty + (int)($th / 2);
            imagefilledellipse($im, $cx, $cy, 92, 92, og_color($im, '#000014', 50));
            imagefilledellipse($im, $cx, $cy, 80, 80, og_color($im, '#1E9BFF', 8));
            imagefilledpolygon($im, [$cx - 12, $cy - 20, $cx - 12, $cy + 20, $cx + 22, $cy], og_color($im, '#FFFFFF'));
        }
    } else {
        // No art on file: soft brand glow instead.
        for ($r = 420; $r > 0; $r -= 6) {
            imagefilledellipse($im, 980, 300, $r * 2, $r * 2, og_color($im, '#1E9BFF', 124));
        }
    }

    $left  = 72;
    $maxW  = $art !== null || $bgPath ? 510 : 640;
    $inter = og_font('Inter-ExtraBold.ttf');
    $semi  = og_font('Inter-SemiBold.ttf');
    $serif = og_font($info['kids'] ? 'Baloo2-ExtraBold.ttf' : 'PlayfairDisplay-ExtraBold.ttf');
    $white = og_color($im, '#FFFFFF');

    // Kicker + headline + subline as one block, shrunk until it fits, then centered above the footer.
    $area = 470;
    for ($hMax = 80; ; $hMax -= 4) {
        [$hPx, $hLines] = og_fit($serif, $hMax, 42, $info['headline'], $maxW, 3);
        [$sPx, $sLines] = $info['subline'] !== '' ? og_fit($semi, 30, 22, $info['subline'], $maxW, 2) : [0, []];
        $height = 76 + count($hLines) * $hPx * 1.1 + ($sLines ? 18 + count($sLines) * $sPx * 1.32 : 0);
        if ($height <= $area || $hMax <= 42) {
            break;
        }
    }
    $top = (int)max(44, 44 + ($area - $height) / 2);

    imagefilledrectangle($im, $left, $top, $left + 64, $top + 6, og_color($im, $rule));
    og_tracked($im, $inter, 22, $left, $top + 50, og_color($im, $accent), $info['kicker'], 4);

    $y = $top + 76;
    foreach ($hLines as $line) {
        $y += (int)round($hPx * 1.1);
        imagettftext($im, $hPx * OG_PT, 0, $left - 2, $y - (int)round($hPx * 0.2), $white, $serif, $line);
    }
    if ($sLines) {
        $y += 18;
        foreach ($sLines as $line) {
            $y += (int)round($sPx * 1.32);
            imagettftext($im, $sPx * OG_PT, 0, $left, $y - (int)round($sPx * 0.28), og_color($im, '#DCDCDC'), $semi, $line);
        }
    }

    $x = og_tracked($im, $inter, 19, $left, 584, $white, 'STAYTHEWAY', 5);
    imagettftext($im, 19 * OG_PT, 0, $x + 10, 584, og_color($im, '#6B7A99'), $semi, '·');
    imagettftext($im, 19 * OG_PT, 0, $x + 30, 584, og_color($im, $accent), $semi, 'staytheway.com');

    return $im;
}
