<?php
declare(strict_types=1);

require __DIR__ . '/app/functions.php';

render_header(
    'Јавне набавке',
    'docs',
    'Јавне набавке КЈП „Наш дом“ Лозница — планови и поступци по годинама.'
);
?>

<section class="docs-page">
    <header class="docs-hero">
        <p class="docs-kicker">Документи</p>
        <h1>Јавне набавке</h1>
        <p class="docs-lead">Документи и информације о јавним набавкама по годинама.</p>
    </header>

    <?php render_accordion(load_year_documents(PROCUREMENT_DIR)); ?>
</section>

<?php render_footer(); ?>
