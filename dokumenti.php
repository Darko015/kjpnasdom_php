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
            Програми пословања и документи о јавним набавкама КЈП „Наш дом“ Лозница.
        </p>
    </header>

    <div class="dokumenti-grid">
        <a href="/program-poslovanja" class="service-card dokumenti-card">
            <div class="service-icon">📄</div>
            <h3>Програм пословања</h3>
            <p>Преглед докумената и планова пословања по годинама</p>
        </a>
        <a href="/javne-nabavke" class="service-card dokumenti-card">
            <div class="service-icon">📋</div>
            <h3>Јавне набавке</h3>
            <p>Документи и информације о јавним набавкама</p>
        </a>
    </div>
</section>

<?php render_footer(); ?>
