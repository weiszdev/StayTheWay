<?php
/**
 * Share card image for one teaching page.
 *   Web: /stw-teachings/_og/card/<page path>.jpg      (rewritten here by _og/.htaccess)
 *   CLI: php card.php rejoicing/bingo.html [out.jpg]   (render for review)
 */
declare(strict_types=1);
require __DIR__ . '/lib.php';

$cli  = PHP_SAPI === 'cli';
$rel  = $cli ? (string)($argv[1] ?? '') : (string)($_GET['p'] ?? '');
$path = og_resolve($rel);
if ($path === null) {
    if ($cli) {
        fwrite(STDERR, "no such page: $rel\n");
        exit(1);
    }
    http_response_code(404);
    exit;
}

$file = og_card_file($path);

if ($cli) {
    if (!empty($argv[2])) {
        copy($file, $argv[2]);
    }
    echo $file, PHP_EOL;
    exit(0);
}
header('Content-Type: image/jpeg');
header('Content-Length: ' . filesize($file));
header('Last-Modified: ' . gmdate('D, d M Y H:i:s', (int)filemtime($file)) . ' GMT');
readfile($file);
