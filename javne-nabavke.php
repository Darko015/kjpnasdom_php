<?php
declare(strict_types=1);

require __DIR__ . '/app/functions.php';

render_header('Јавне набавке', 'docs');
?>

<section class="page-header">
    <h1>Јавне набавке</h1>
    <p class="page-description">Документи и информације о јавним набавкама по годинама</p>
</section>

<?php render_accordion(load_year_documents(PROCUREMENT_DIR)); ?>

<?php render_footer(); ?>
