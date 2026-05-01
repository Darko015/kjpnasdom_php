<?php
declare(strict_types=1);

$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$path = is_string($uri) ? $uri : '/';

if ($path !== '/' && is_file(__DIR__ . $path)) {
    return false;
}

$routes = [
    '#^/arhiva-obavestenja/?$#' => 'arhiva-obavestenja.php',
    '#^/program-poslovanja/?$#' => 'program-poslovanja.php',
    '#^/javne-nabavke/?$#' => 'javne-nabavke.php',
    '#^/dokumenti/?$#' => 'dokumenti.php',
    '#^/o-preduzecu/?$#' => 'o-preduzecu.php',
    '#^/usluge/?$#' => 'usluge.php',
    '#^/kontakt/?$#' => 'kontakt.php',
    '#^/robots\.txt$#' => 'robots.php',
    '#^/sitemap\.xml$#' => 'sitemap.php',
];

if (preg_match('#^/vesti/([A-Za-z0-9_-]+)/?$#', $path, $matches) === 1) {
    $_GET['slug'] = $matches[1];
    require __DIR__ . '/vesti.php';
    return true;
}

foreach ($routes as $pattern => $target) {
    if (preg_match($pattern, $path) === 1) {
        require __DIR__ . '/' . $target;
        return true;
    }
}

if ($path === '/' || $path === '') {
    require __DIR__ . '/index.php';
    return true;
}

http_response_code(404);
echo '404 Not Found';
return true;
