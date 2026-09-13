<?php
/**
 * Serves a teaching page with share tags pointing at its own card.
 * Every *.html under /stw-teachings/ is rewritten here by stw-teachings/.htaccess.
 * Opt a page out with: <meta name="stw-og" content="manual">
 */
declare(strict_types=1);
require __DIR__ . '/lib.php';

$path = og_resolve((string)($_GET['f'] ?? ''));
header('Content-Type: text/html; charset=UTF-8');
if ($path === null) {
    http_response_code(404);
    echo '<!DOCTYPE html><title>Not found</title><p>Page not found. <a href="/teachings/">All teachings</a></p>';
    exit;
}
header('Last-Modified: ' . gmdate('D, d M Y H:i:s', (int)filemtime($path)) . ' GMT');

$html = (string)file_get_contents($path);

if (!preg_match('/<meta\s+name=["\']stw-og["\']\s+content=["\']manual["\']/i', $html)) {
    $rel  = og_rel($path);
    $info = og_info($path);
    $img  = OG_SITE . '/stw-teachings/_og/card/' . implode('/', array_map('rawurlencode', explode('/', $rel)))
          . '.jpg?v=' . substr(sha1(OG_VERSION . '|' . $info['mtime'] . '|' . $info['landing_mtime']), 0, 10);
    $e    = static fn(string $s): string => htmlspecialchars($s, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $alt  = $info['headline'] . ($info['subline'] !== '' && $info['subline'] !== $info['headline'] ? ' — ' . $info['subline'] : '');

    $html = (string)preg_replace(
        '/[ \t]*<meta\s+[^>]*(?:property|name)=["\'](?:og:image(?::[a-z_]+)?|twitter:image(?::[a-z_]+)?|twitter:card)["\'][^>]*>[ \t]*\r?\n?/i',
        '', $html);

    $tags = [];
    if (og_meta($html, 'og:title') === '' && preg_match('/<title[^>]*>(.*?)<\/title>/is', $html, $m)) {
        $tags[] = '<meta property="og:title" content="' . $e(og_text($m[1])) . '" />';
        $tags[] = '<meta property="og:type" content="website" />';
        $tags[] = '<meta property="og:site_name" content="StayTheWay" />';
    }
    if (og_meta($html, 'og:url') === '') {
        $tags[] = '<meta property="og:url" content="' . $e(OG_SITE . strtok((string)($_SERVER['REQUEST_URI'] ?? '/'), '?')) . '" />';
    }
    array_push($tags,
        '<meta property="og:image" content="' . $e($img) . '" />',
        '<meta property="og:image:secure_url" content="' . $e($img) . '" />',
        '<meta property="og:image:type" content="image/jpeg" />',
        '<meta property="og:image:width" content="' . OG_W . '" />',
        '<meta property="og:image:height" content="' . OG_H . '" />',
        '<meta property="og:image:alt" content="' . $e($alt) . '" />',
        '<meta name="twitter:card" content="summary_large_image" />',
        '<meta name="twitter:image" content="' . $e($img) . '" />'
    );
    $block = "<!-- share card: /stw-teachings/_og/ -->\n" . implode("\n", $tags) . "\n";
    $html  = stripos($html, '</head>') !== false
        ? (string)preg_replace('/<\/head>/i', $block . '</head>', $html, 1)
        : $block . $html;
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'HEAD') {
    echo $html;
}
