<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title) ?></title>
    <?php if ($metaDescription !== ''): ?>
    <meta name="description" content="<?= e($metaDescription) ?>">
    <?php endif; ?>
    <?php
    $canonical = current_canonical_url();
    $ogTitle = $title !== '' ? $title : SITE_NAME;
    $ogDescription = $metaDescription !== '' ? $metaDescription : 'Комунално јавно предузеће КЈП „Наш дом“ Лозница.';
    $ogImage = SITE_URL . '/static/images/1.png';
    ?>
    <link rel="canonical" href="<?= e($canonical) ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?= e(SITE_NAME) ?>">
    <meta property="og:title" content="<?= e($ogTitle) ?>">
    <meta property="og:description" content="<?= e($ogDescription) ?>">
    <meta property="og:url" content="<?= e($canonical) ?>">
    <meta property="og:image" content="<?= e($ogImage) ?>">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="icon" type="image/png" sizes="32x32" href="/static/images/favicon-32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/static/images/favicon-16.png">
    <link rel="apple-touch-icon" href="/static/images/apple-touch-icon.png">
    <link rel="stylesheet" href="/static/css/main.css">
</head>
<body data-active-menu="<?= e($activeMenu) ?>">
    <a href="#main-content" class="skip-link">Прескочи на садржај</a>
    <header class="site-header">
        <nav class="top-nav" role="navigation" aria-label="Главни мени">
            <a href="/" class="brand" aria-label="КЈП Наш дом Лозница - почетна">
                <img src="/static/images/1.png" alt="КЈП Наш дом Лозница" class="brand-logo">
            </a>
            <button type="button" class="nav-toggle" aria-label="Отвори мени" aria-expanded="false" aria-controls="main-menu">
                <span class="nav-toggle-icon"></span>
            </button>
            <ul class="menu" id="main-menu">
                <li data-key="home"><a href="/">Почетна</a></li>
                <li data-key="about"><a href="/o-preduzecu">О предузећу</a></li>
                <li data-key="services"><a href="/usluge">Услуге</a></li>
                <li data-key="docs"><a href="/dokumenti">Документи</a></li>
                <li data-key="contact"><a href="/kontakt">Контакт</a></li>
            </ul>
        </nav>
    </header>
    <main id="main-content">
