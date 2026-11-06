<?php
declare(strict_types=1);

require __DIR__ . '/app/functions.php';

render_header(
    'Документи',
    'docs',
    'Програм пословања и јавне набавке КЈП „Наш дом“ Лозница — документи по годинама.'
);
?>

<section class="dokumenti-page">
    <header class="dokumenti-hero">
        <p class="dokumenti-kicker">Документи</p>
        <h1>Документи</h1>
        <p class="dokumenti-lead">
            Програми пословања, извештаји о пословању и јавне набавке КЈП „Наш дом“ Лозница.
        </p>
    </header>

    <div class="dokumenti-grid">
        <a href="/program-poslovanja" class="service-card dokumenti-card">
            <div class="service-icon">📄</div>
            <h3>Програм пословања</h3>
            <p>Преглед докумената и планова пословања по годинама</p>
        </a>
        <a href="/izvestaji-poslovanja" class="service-card dokumenti-card">
            <div class="service-icon">📊</div>
            <h3>Извештаји о пословању</h3>
            <p>Квартални извештаји и извештаји независног ревизора, 2021–2026</p>
        </a>
        <a href="/javne-nabavke" class="service-card dokumenti-card">
            <div class="service-icon">📋</div>
            <h3>Јавне набавке</h3>
            <p>Документи и информације о јавним набавкама</p>
        </a>
    </div>
</section>

<?php render_footer(); ?>
