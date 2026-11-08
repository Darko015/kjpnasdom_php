<?php
declare(strict_types=1);

require __DIR__ . '/app/functions.php';

render_header(
    'Извештаји о пословању',
    'docs',
    'Квартални извештаји о пословању и извештаји независног ревизора КЈП „Наш дом“ Лозница, 2021–2026.'
);
?>

<section class="docs-page">
    <header class="docs-hero">
        <p class="docs-kicker">Документи</p>
        <h1>Извештаји о пословању</h1>
        <p class="docs-lead">Квартални извештаји и извештаји независног ревизора, 2021–2026.</p>
    </header>

    <?php render_accordion(load_year_documents(REPORT_DIR)); ?>
</section>

<?php render_footer(); ?>
