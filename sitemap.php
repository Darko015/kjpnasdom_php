<?php
declare(strict_types=1);

require __DIR__ . '/app/functions.php';

$base = 'https://www.kjpnasdom.rs';
$urls = [
    '/',
    '/o-preduzecu',
    '/usluge',
    '/dokumenti',
    '/program-poslovanja',
    '/javne-nabavke',
    '/kontakt',
    '/arhiva-obavestenja',
];

foreach (load_all_news() as $news) {
    $urls[] = '/vesti/' . rawurlencode($news['slug']);
}

header('Content-Type: application/xml; charset=utf-8');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($urls as $url): ?>
    <url>
        <loc><?= e($base . $url) ?></loc>
        <changefreq>weekly</changefreq>
        <priority><?= $url === '/' ? '1.0' : '0.8' ?></priority>
    </url>
<?php endforeach; ?>
</urlset>
