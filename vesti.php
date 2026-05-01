<?php
declare(strict_types=1);

require __DIR__ . '/app/functions.php';

$slug = $_GET['slug'] ?? '';
$news = is_string($slug) ? load_news_by_slug($slug) : null;

if ($news === null) {
    http_response_code(404);
    render_header('Страница није пронађена');
    ?>
    <section class="not-found-page">
        <h1>Страница није пронађена</h1>
        <p>Тражено обавештење не постоји или је линк погрешан.</p>
        <a href="/" class="btn">На почетну</a>
    </section>
    <?php
    render_footer();
    exit;
}

render_header($news['title'], '', $news['summary']);
?>

<section class="news-page">
    <article class="news-article">
        <header class="news-header">
            <h1><?= e($news['title']) ?></h1>
            <?php if ($news['date'] !== ''): ?><time class="news-date"><?= e($news['date']) ?></time><?php endif; ?>
        </header>

        <?php if ($news['summary'] !== ''): ?>
            <p class="news-summary"><?= e($news['summary']) ?></p>
        <?php endif; ?>

        <?php if ($news['images'] !== []): ?>
            <div class="news-gallery" id="news-gallery">
                <?php foreach ($news['images'] as $index => $image): ?>
                    <img src="<?= e($image) ?>" data-index="<?= e($index) ?>" class="news-thumb" loading="lazy" alt="<?= e($news['title']) ?>">
                <?php endforeach; ?>
            </div>

            <div class="lightbox" id="lightbox" hidden>
                <button class="lightbox-close" id="lightbox-close" type="button" aria-label="Затвори">×</button>
                <button class="lightbox-prev" id="lightbox-prev" type="button" aria-label="Претходна">‹</button>
                <img id="lightbox-image" alt="">
                <button class="lightbox-next" id="lightbox-next" type="button" aria-label="Следећа">›</button>
            </div>
        <?php endif; ?>

        <?php if ($news['content'] !== ''): ?>
            <div class="news-content">
                <?php foreach (preg_split('/\R{2,}/u', trim($news['content'])) ?: [] as $paragraph): ?>
                    <p><?= nl2br(e($paragraph)) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </article>
</section>

<?php render_footer(); ?>
