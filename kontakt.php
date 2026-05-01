<?php
declare(strict_types=1);

require __DIR__ . '/app/functions.php';

render_header(
    'Контакт',
    'contact',
    'Контакт подаци КЈП „Наш дом“ Лозница — управа, кориснички сервис, рекламације, адреса и мапа.'
);
?>

<section class="contact-page">
    <header class="contact-hero">
        <p class="contact-kicker">Контакт</p>
        <h1>Контактирајте КЈП „Наш дом“</h1>
        <p class="contact-lead">
            За сва питања у вези са комуналним услугама, рекламацијама и сарадњом можете нас контактирати путем телефона, електронске поште или лично у управи предузећа.
        </p>
    </header>

    <section class="contact-reklamacije contact-card">
        <h2>Рекламације</h2>
        <p>
            Рекламације у вези са пруженим комуналним услугама можете поднети писменим путем, е-поштом или лично у управи предузећа односно корисничком сервису.
        </p>
    </section>

    <section class="contact-grid">
        <div class="contact-card">
            <h2>Управа предузећа</h2>
            <p><strong>Адреса:</strong><br>КЈП „Наш дом“ Лозница<br>Булевар Доситеја Обрадовића 6<br>15300 Лозница, Србија</p>
            <p><strong>Телефон:</strong><br><a href="tel:+381157882291">(015) 7882 291</a></p>
            <p><strong>Факс:</strong><br><a href="tel:+381157882291">(015) 7882 291</a></p>
            <p><strong>E-mail:</strong><br><a href="mailto:kjpnasdomloznica@gmail.com">kjpnasdomloznica@gmail.com</a></p>
            <p><strong>Радно време управе:</strong><br>Понедељак-петак: 07:00-15:00</p>
            <p><strong>Робна пијаца и ресторан:</strong><br><a href="tel:+38115882342">(015) 882 342</a></p>
            <p><strong>Зелена пијаца:</strong><br><a href="tel:+38115889386">(015) 889 386</a></p>
            <p><strong>Градско гробље:</strong><br><a href="tel:+38115872030">(015) 872 030</a></p>
        </div>

        <div class="contact-card">
            <h2>Кориснички сервис</h2>
            <p>За пријаву кварова, рекламација и информације о рачунима:</p>
            <p><strong>Телефон:</strong><br><a href="tel:0800001005">0800 001 005</a></p>
            <p><strong>E-mail:</strong><br><a href="mailto:marijana.nasdom@gmail.com">marijana.nasdom@gmail.com</a></p>
            <p><strong>Радно време:</strong><br>Понедељак-петак: 07:00-19:00<br>Субота: 08:00-13:00</p>
        </div>
    </section>

    <section class="contact-map">
        <h2>Како да нас пронађете</h2>
        <p>Управна зграда КЈП „Наш дом“ налази се у Лозници.</p>
        <div class="map-embed">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1421.9956831974755!2d19.223953052954453!3d44.53580933083745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4759619bdd211e9b%3A0xbe88eacb4d9ca2c0!2zTmHFoSBEb20!5e0!3m2!1ssr!2srs!4v1772050620735!5m2!1ssr!2srs"
                width="100%"
                height="320"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>
</section>

<?php render_footer(); ?>
