<?php
declare(strict_types=1);

require __DIR__ . '/app/functions.php';

render_header(
    'Програм пословања',
    'docs',
    'Програми пословања КЈП „Наш дом“ Лозница за 2021–2026, са изменама и средњорочним планом.'
);
?>

<section class="page-header">
    <h1>Програм пословања</h1>
    <p class="page-description">Годишњи програми пословања и њихове измене, 2021–2026.</p>
    <p class="page-extra">
        <a class="btn-primary" href="/static/media/program_poslovanja/srednjorocni_plan_2022-2026.pdf" target="_blank" rel="noopener">Средњорочни план 2022–2026. (PDF)</a>
    </p>
</section>

<?php render_accordion(load_year_documents(PROGRAM_DIR)); ?>

<?php render_footer(); ?>
