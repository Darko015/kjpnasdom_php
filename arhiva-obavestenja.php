<?php
declare(strict_types=1);

require __DIR__ . '/app/functions.php';

render_header(
    'Архива обавештења',
    '',
    'Старија обавештења и вести КЈП „Наш дом“ Лозница.'
);
?>

<section class="arhiva-page">
    <header class="arhiva-hero">
        <p class="arhiva-kicker">Архива</p>
        <h1>Архива обавештења</h1>
        <p class="arhiva-lead">
            Старија обавештења и вести КЈП „Наш дом“ Лозница. Најновија обавештења су на <a href="/#obavestenja">почетној страници</a>.
        </p>
    </header>

    <div class="obavestenja-grid">
        <?php render_news_cards(load_all_news()); ?>
    </div>
</section>

<?php render_footer(); ?>
