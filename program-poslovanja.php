<?php
declare(strict_types=1);

require __DIR__ . '/app/functions.php';

render_header('Програм пословања', 'docs');
?>

<section class="page-header">
    <h1>Програм пословања</h1>
    <p class="page-description">Преглед докумената и планова пословања по годинама</p>
</section>

<?php render_accordion(load_year_documents(PROGRAM_DIR)); ?>

<?php render_footer(); ?>
