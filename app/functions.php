<?php
declare(strict_types=1);

const SITE_NAME = 'КЈП „Наш дом“ Лозница';
const NEWS_DIR = __DIR__ . '/../static/media/vesti';
const PROGRAM_DIR = __DIR__ . '/../static/media/program_poslovanja';
const REPORT_DIR = __DIR__ . '/../static/media/izvestaji_poslovanja';
const PROCUREMENT_DIR = __DIR__ . '/../static/media/javne_nabavke';
const UPRAVA_JSON = __DIR__ . '/../static/media/data/uprava.json';

function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function read_json_file(string $path, array $fallback = []): array
{
    if (!is_file($path)) {
        return $fallback;
    }

    $json = file_get_contents($path);
    if ($json === false) {
        return $fallback;
    }

    $data = json_decode($json, true);
    return is_array($data) ? $data : $fallback;
}

function normalize_date(string $date): ?DateTimeImmutable
{
    $clean = trim($date);
    $clean = rtrim($clean, '.');
    foreach (['!d.m.Y', '!Y-m-d'] as $format) {
        $parsed = DateTimeImmutable::createFromFormat($format, $clean);
        if ($parsed instanceof DateTimeImmutable) {
            return $parsed;
        }
    }

    return null;
}

function is_safe_slug(string $slug): bool
{
    return (bool) preg_match('/^[A-Za-z0-9_-]+$/', $slug);
}

function public_media_url(string $absolutePath): string
{
    $root = realpath(__DIR__ . '/..');
    $real = realpath($absolutePath);
    if ($root === false || $real === false || strncmp($real, $root, strlen($root)) !== 0) {
        return '#';
    }

    return '/' . str_replace(DIRECTORY_SEPARATOR, '/', ltrim(substr($real, strlen($root)), DIRECTORY_SEPARATOR));
}

function load_news_by_slug(string $slug): ?array
{
    if (!is_safe_slug($slug)) {
        return null;
    }

    $dir = NEWS_DIR . '/' . $slug;
    $meta = read_json_file($dir . '/meta.json');
    if ($meta === []) {
        return null;
    }

    $images = [];
    foreach (glob($dir . '/*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}', GLOB_BRACE) ?: [] as $image) {
        $images[] = public_media_url($image);
    }

    sort($images, SORT_NATURAL | SORT_FLAG_CASE);

    return [
        'title' => $meta['title'] ?? 'Без наслова',
        'date' => $meta['date'] ?? '',
        'slug' => $slug,
        'summary' => $meta['summary'] ?? '',
        'content' => $meta['content'] ?? '',
        'images' => $images,
        'link' => '/vesti/' . rawurlencode($slug),
        'image' => $images[0] ?? '',
    ];
}

function load_all_news(): array
{
    $items = [];
    foreach (scandir(NEWS_DIR) ?: [] as $entry) {
        if ($entry === '.' || $entry === '..') {
            continue;
        }

        if (!is_dir(NEWS_DIR . '/' . $entry)) {
            continue;
        }

        $news = load_news_by_slug($entry);
        if ($news !== null) {
            $items[] = $news;
        }
    }

    usort($items, static function (array $a, array $b): int {
        $da = normalize_date($a['date'] ?? '');
        $db = normalize_date($b['date'] ?? '');

        if ($da === null && $db === null) {
            return strcmp($b['slug'], $a['slug']);
        }

        if ($da === null) {
            return 1;
        }

        if ($db === null) {
            return -1;
        }

        return $db <=> $da;
    });

    return $items;
}

function load_year_documents(string $baseDir): array
{
    $years = [];
    foreach (scandir($baseDir) ?: [] as $year) {
        if ($year === '.' || $year === '..' || !is_dir($baseDir . '/' . $year)) {
            continue;
        }

        $yearDir = $baseDir . '/' . $year;
        $meta = read_json_file($yearDir . '/meta.json');
        $files = [];

        foreach (scandir($yearDir) ?: [] as $filename) {
            $path = $yearDir . '/' . $filename;
            if (!is_file($path)) {
                continue;
            }

            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            if (!in_array($ext, ['pdf', 'doc', 'docx', 'xls', 'xlsx'], true)) {
                continue;
            }

            $files[] = [
                'title' => $meta[$filename] ?? pathinfo($filename, PATHINFO_FILENAME),
                'url' => public_media_url($path),
                'extension' => strtoupper($ext),
                'file' => $filename,
            ];
        }

        if ($files === []) {
            continue;
        }

        usort($files, static function (array $a, array $b): int {
            return strnatcasecmp($a['file'], $b['file']);
        });
        $years[] = ['year' => $year, 'files' => $files];
    }

    usort($years, static function (array $a, array $b): int {
        return strcmp($b['year'], $a['year']);
    });
    return $years;
}

function render_news_cards(array $items): void
{
    foreach ($items as $item) {
        ?>
        <article class="obavestenje-card">
            <a href="<?= e($item['link']) ?>" class="obavestenje-card-link" rel="noopener">
                <div class="obavestenje-card-image-wrap">
                    <?php if (!empty($item['image'])): ?>
                        <img src="<?= e($item['image']) ?>" alt="<?= e($item['title']) ?>" class="obavestenje-card-image" loading="lazy" width="400" height="250">
                    <?php else: ?>
                        <img src="/static/images/logo-placeholder.png" alt="КЈП „Наш дом“ Лозница" class="obavestenje-card-image" loading="lazy" width="400" height="250">
                    <?php endif; ?>
                </div>
                <div class="obavestenje-card-body">
                    <?php if (!empty($item['date'])): ?><time class="obavestenje-date"><?= e($item['date']) ?></time><?php endif; ?>
                    <h3 class="obavestenje-title"><?= e($item['title']) ?></h3>
                    <p class="obavestenje-excerpt"><?= e($item['summary']) ?></p>
                    <span class="obavestenje-more">Опширније &rarr;</span>
                </div>
            </a>
        </article>
        <?php
    }
}

function render_accordion(array $years): void
{
    ?>
    <div class="accordion">
        <?php foreach ($years as $year): ?>
            <div class="accordion-item">
                <button class="accordion-header" type="button">
                    <?= e($year['year']) ?>
                    <span class="icon">+</span>
                </button>
                <div class="accordion-body">
                    <ul>
                        <?php foreach ($year['files'] as $file): ?>
                            <li>
                                <a href="<?= e($file['url']) ?>" target="_blank" rel="noopener">
                                    <?= e($file['title']) ?>
                                    <span class="file-extension"><?= e($file['extension']) ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
}

function render_header(string $title, string $activeMenu = '', string $metaDescription = ''): void
{
    require __DIR__ . '/../includes/header.php';
}

function render_footer(): void
{
    require __DIR__ . '/../includes/footer.php';
}
