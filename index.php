<?php
declare(strict_types=1);

// Fallback router for PHP built-in server when started without router.php.
$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$requestPath = is_string($requestPath) ? $requestPath : '/';

if ($requestPath !== '/' && $requestPath !== '/index.php') {
    $directRoutes = [
        '/arhiva-obavestenja' => 'arhiva-obavestenja.php',
        '/program-poslovanja' => 'program-poslovanja.php',
        '/izvestaji-poslovanja' => 'izvestaji-poslovanja.php',
        '/javne-nabavke' => 'javne-nabavke.php',
        '/dokumenti' => 'dokumenti.php',
        '/o-preduzecu' => 'o-preduzecu.php',
        '/usluge' => 'usluge.php',
        '/kontakt' => 'kontakt.php',
        '/robots.txt' => 'robots.php',
        '/sitemap.xml' => 'sitemap.php',
    ];

    $normalized = rtrim($requestPath, '/');
    if ($normalized === '') {
        $normalized = '/';
    }

    if (preg_match('#^/vesti/([A-Za-z0-9_-]+)$#', $normalized, $matches) === 1) {
        $_GET['slug'] = $matches[1];
        require __DIR__ . '/vesti.php';
        exit;
    }

    if (isset($directRoutes[$normalized])) {
        require __DIR__ . '/' . $directRoutes[$normalized];
        exit;
    }
}

require __DIR__ . '/app/functions.php';

$allNews = load_all_news();
$visibleNews = array_slice($allNews, 0, 6);

render_header(
    'КЈП „Наш дом“ Лозница',
    'home',
    'Комунално јавно предузеће КЈП „Наш дом“ Лозница — чистоћа, зеленила, зимска служба, пијаце, погребне услуге, зоохигијена.'
);
?>

<section class="home-page">
    <div class="hero">
        <div class="hero-content">
            <h1 class="hero-title">КЈП „Наш дом" Лозница</h1>
            <p class="hero-subtitle">
                Комунално јавно предузеће које пружа услуге од општег интереса за град Лозницу: чистоћа, одржавање јавних површина и зеленила, зимска служба, пијачне и погребне услуге, као и послови зоохигијене.
            </p>
            <div class="hero-cta">
                <a href="/kontakt" class="btn btn-primary">Контакт</a>
                <a href="/dokumenti" class="btn btn-secondary">Документи</a>
            </div>
        </div>
    </div>

    <section class="about-section">
        <h2 class="section-title">О предузећу</h2>
        <p>
            Скупштина општине Лозница је 24. новембра 1965. године донела решење о оснивању предузећа за газдовање стамбеним зградама у друштвеној својини под називом СП „Наш дом“. Током развоја и организационих промена предузеће је наставило пословање као КЈП „Наш дом“.
        </p>
        <p>
            Данас предузеће обавља комуналне делатности које су важне за свакодневни живот грађана и функционисање града. Детаљније информације о организацији и управљању доступне су на страници <a href="/o-preduzecu">О предузећу</a>.
        </p>
    </section>

    <section class="obavestenja-section" id="obavestenja">
        <h2 class="section-title">Обавештења</h2>
        <div class="obavestenja-grid">
            <?php render_news_cards($visibleNews); ?>
        </div>
        <?php if (count($allNews) > count($visibleNews)): ?>
            <p class="obavestenja-archive-wrap">
                <a href="/arhiva-obavestenja" class="btn btn-archive">Старија обавештења &rarr;</a>
            </p>
        <?php endif; ?>
    </section>

    <section class="quick-links">
        <h2 class="section-title">Документи и важне информације</h2>
        <div class="services-grid">
            <a href="/program-poslovanja" class="service-card">
                <div class="service-icon">📄</div>
                <h3>Програм пословања</h3>
                <p>Преглед докумената и планова пословања по годинама</p>
            </a>

            <a href="/izvestaji-poslovanja" class="service-card">
                <div class="service-icon">📊</div>
                <h3>Извештаји о пословању</h3>
                <p>Квартални извештаји и извештаји ревизора, 2021–2026</p>
            </a>

            <a href="/javne-nabavke" class="service-card">
                <div class="service-icon">📋</div>
                <h3>Јавне набавке</h3>
                <p>Документи и информације о јавним набавкама</p>
            </a>

            <a href="/o-preduzecu" class="service-card">
                <div class="service-icon">ℹ️</div>
                <h3>О предузећу</h3>
                <p>Историја, делатности и управљање предузећем</p>
            </a>

            <a href="/kontakt" class="service-card">
                <div class="service-icon">📞</div>
                <h3>Контакт</h3>
                <p>Адреса, телефони, е-пошта и информације за рекламације</p>
            </a>
        </div>
    </section>
</section>

<?php render_footer(); ?>
