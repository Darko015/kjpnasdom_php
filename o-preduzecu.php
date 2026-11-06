<?php
declare(strict_types=1);

require __DIR__ . '/app/functions.php';

$uprava = read_json_file(UPRAVA_JSON);

render_header(
    'О предузећу',
    'about',
    'Историјат, основне делатности и управљање КЈП „Наш дом“ Лозница.'
);
?>

<section class="about-page">
    <header class="about-hero">
        <p class="about-kicker">О предузећу</p>
        <h1>КЈП „Наш дом“ Лозница</h1>
        <p class="about-lead">
            Комунално јавно предузеће задужено за чисту, уређену и безбедну Лозницу, од сакупљања отпада и одржавања зелених површина до пијаца, погребних услуга и зоохигијене.
        </p>
    </header>

    <section class="about-section">
        <h2>Историјат</h2>
        <p>Скупштина општине Лозница је на заједничкој седници Општинског већа и Већа радних заједница, одржаној 24. новембра 1965. године, донела решење о оснивању предузећа за газдовање стамбеним зградама у друштвеној својини под називом <strong>СП „Наш дом“</strong>.</p>
        <p>Радници КП „Градски водовод“ и КП „Чистоћа“ 1967. године припојили су се Стамбеном предузећу „Наш дом“, тако да од 1. јануара 1968. године предузеће послује под називом КСП „Наш дом“.</p>
        <p>Изменом законских прописа предузеће је мењало назив: 1976. године у КП „Наш дом“, 1978. године у КРО „Наш дом“. Одвајањем ООУР „Водовод“ у посебно предузеће и удруживањем „Хигијене“, „Пијаце“ и дела РЗ, од 1. јула 1987. године формирана је јединствена РО. Усвајањем Закона о предузећима наставља пословање под називом <strong>КЈП „Наш дом“</strong>.</p>
    </section>

    <section class="about-section">
        <h2>Основне делатности</h2>
        <p>У широкој лепези послова које предузеће обавља, најзначајније место заузимају комуналне услуге којима се задовољавају индивидуалне потребе грађана и правних субјеката, као и заједничке потребе града: изношење и депоновање отпада, чишћење и прање јавних површина, уређење и одржавање зеленила, погребне услуге, пијачни послови и угоститељство, вашариште, хватање паса луталица, чишћење снега и радови на смањењу ризика од поплава на водотоцима II реда.</p>
        <div class="about-grid">
            <a href="/usluge#cistoca" class="about-card about-card-link"><h3>Чистоћа и отпад</h3><p>Сакупљање, одвожење и депоновање комуналног отпада, чишћење улица и јавних површина.</p></a>
            <a href="/usluge#zelenila" class="about-card about-card-link"><h3>Зеленила и јавне површине</h3><p>Одржавање паркова, травњака, дрвореда и сезонско уређење града.</p></a>
            <a href="/usluge#zimska-sluzba" class="about-card about-card-link"><h3>Зимска служба</h3><p>Чишћење снега и посипање пешачких стаза, тротоара и прилаза установама.</p></a>
            <a href="/usluge#pijace" class="about-card about-card-link"><h3>Пијаце</h3><p>Организација и одржавање зелених и других пијаца на територији града.</p></a>
            <a href="/usluge#pogrebne-usluge" class="about-card about-card-link"><h3>Погребне услуге</h3><p>Организација и пружање погребних услуга у складу са прописима и стандардима.</p></a>
            <a href="/usluge#zoohigijena" class="about-card about-card-link"><h3>Зоохигијена</h3><p>Прихватилиште за напуштене псе, удомљавање и брига о добробити животиња.</p></a>
            <a href="/usluge#ugostiteljstvo" class="about-card about-card-link"><h3>Угоститељство и вашариште</h3><p>Угоститељске услуге уз пијачне послове и услуге вашаришта.</p></a>
            <a href="/usluge#vodotoci" class="about-card about-card-link"><h3>Водотоци II реда</h3><p>Радови на смањењу ризика од поплава на водотоцима другог реда.</p></a>
        </div>
        <p>Предузеће је организовано као јавно предузеће, послује средствима у државној својини и по величини спада у мала предузећа.</p>
    </section>

    <section class="about-section about-people">
        <div>
            <h2>Управљање</h2>
            <h3>Надзорни одбор</h3>
            <ul>
                <?php foreach (($uprava['board'] ?? []) as $person): ?>
                    <li class="person">
                        <strong><?= e($person['name'] ?? '') ?></strong> - <?= e($person['role'] ?? '') ?><br>
                        <button
                            type="button"
                            class="bio-trigger"
                            data-bio-name="<?= e($person['name'] ?? '') ?>"
                            data-bio-role="<?= e($person['role'] ?? '') ?>"
                            data-bio-text="<?= e($person['bio'] ?? '') ?>"
                        >
                            Прикажи биографију
                        </button>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="about-director">
            <h3>Директор и извршни директор</h3>
            <?php foreach (['director', 'executiveDirector'] as $key): ?>
                <?php $person = $uprava[$key] ?? []; ?>
                <div class="person-block">
                    <p class="about-director-name"><?= e($person['name'] ?? '') ?></p>
                    <p class="person-role"><?= e($person['role'] ?? '') ?></p>
                    <button
                        type="button"
                        class="bio-trigger bio-trigger-dark"
                        data-bio-name="<?= e($person['name'] ?? '') ?>"
                        data-bio-role="<?= e($person['role'] ?? '') ?>"
                        data-bio-text="<?= e($person['bio'] ?? '') ?>"
                    >
                        Прикажи биографију
                    </button>
                </div>
                <?php if ($key === 'director'): ?><hr class="person-separator"><?php endif; ?>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="about-section">
        <h2>Организациона шема</h2>
        <p>Преглед организационе структуре КЈП „Наш дом“.</p>
        <a href="/static/media/struktura/organizaciona_struktura_2026.pdf" target="_blank" rel="noopener" class="btn-primary">
            Отвори организациону шему (PDF)
        </a>
    </section>
</section>

<div class="bio-modal" id="bio-modal" hidden>
    <div class="bio-modal-backdrop" data-bio-close></div>
    <div class="bio-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="bio-modal-title">
        <button type="button" class="bio-modal-close" data-bio-close aria-label="Затвори">×</button>
        <h3 id="bio-modal-title" class="bio-modal-title"></h3>
        <p class="bio-modal-role" id="bio-modal-role"></p>
        <div class="bio-modal-content" id="bio-modal-content"></div>
    </div>
</div>

<?php render_footer(); ?>
