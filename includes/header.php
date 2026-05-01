<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title) ?></title>
    <?php if ($metaDescription !== ''): ?><meta name="description" content="<?= e($metaDescription) ?>"><?php endif; ?>
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
