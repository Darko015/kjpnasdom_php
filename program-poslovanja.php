<?php
declare(strict_types=1);

require __DIR__ . '/app/functions.php';

render_header(
    'Програм пословања',
    'docs',
    'Програми пословања КЈП „Наш дом“ Лозница за 2021–2026, са изменама и средњорочним планом.'
);
?>

<section class="docs-page">
    <header class="docs-hero">
        <p class="docs-kicker">Документи</p>
        <h1>Програм пословања</h1>
        <p class="docs-lead">Годишњи програми пословања и њихове измене, 2021–2026.</p>
        <p class="docs-extra">
            <a class="btn btn-primary" href="/static/media/program_poslovanja/srednjorocni_plan_2022-2026.pdf" target="_blank" rel="noopener">Средњорочни план 2022–2026. (PDF)</a>
        </p>
    </header>

    <?php render_accordion(load_year_documents(PROGRAM_DIR)); ?>
</section>

<?php render_footer(); ?>
