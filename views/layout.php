<?php
/** @var App\Localization\Translator $t */
/** @var string $content */
/** @var array<string, string> $languages */
/** @var string $currentLocale */
/** @var string $currentTheme */
/** @var array<string, mixed> $clientConfig */
/** @var string[] $themes */
/** @var array<string, string> $localeUrls */
/** @var array<string, mixed> $pageMeta */
/** @var string $homeUrl */

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'nerp.app';
if ($host === 'localhost' || str_starts_with($host, '127.') || str_starts_with($host, '0.0.0.0')) {
    $host = 'nerp.app';
}
if ($host === 'nerp.app') {
    $scheme = 'https';
}
$uri = strtok($_SERVER['REQUEST_URI'] ?? '/', '?') ?: '/';
$canonical = $scheme . '://' . $host . $uri;
$localeCode = (string) $t->get('app.locale_code', [], $currentLocale);
$heroIllustration = asset('assets/img/hero-illustration.svg');
$ogImageUrl = $scheme . '://' . $host . $heroIllustration;
$favicon = asset('assets/img/favicon.svg');
$ogImageAltDefault = (string) ($t->get('meta.og_image_alt') ?? '');
$pageMeta = is_array($pageMeta ?? null) ? $pageMeta : [];
$metaTitle = (string) ($pageMeta['title'] ?? $t->get('meta.title'));
$metaDescription = (string) ($pageMeta['description'] ?? $t->get('meta.description'));
$metaKeywords = (string) ($pageMeta['keywords'] ?? $t->get('meta.keywords'));
$metaOgTitle = (string) ($pageMeta['og_title'] ?? $t->get('meta.og_title'));
$metaOgDescription = (string) ($pageMeta['og_description'] ?? $t->get('meta.og_description'));
$metaOgImageAlt = (string) ($pageMeta['og_image_alt'] ?? $ogImageAltDefault);
?>
<!DOCTYPE html>
<html lang="<?= e($localeCode); ?>" data-theme="<?= e($currentTheme); ?>" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title><?= e($metaTitle); ?></title>
    <meta name="description" content="<?= e($metaDescription); ?>">
    <meta name="keywords" content="<?= e($metaKeywords); ?>">
    <link rel="canonical" href="<?= e($canonical); ?>">
    <?php foreach ($localeUrls as $code => $path): ?>
        <link rel="alternate" hreflang="<?= e($code); ?>" href="<?= e($scheme . '://' . $host . $path); ?>">
    <?php endforeach; ?>
    <link rel="alternate" hreflang="x-default" href="<?= e($scheme . '://' . $host . '/'); ?>">
    <!-- SEO: Enriched Open Graph and Twitter metadata for richer SERP snippets -->
    <meta property="og:site_name" content="nERP">
    <meta property="og:title" content="<?= e($metaOgTitle); ?>">
    <meta property="og:description" content="<?= e($metaOgDescription); ?>">
    <meta property="og:url" content="<?= e($canonical); ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="<?= e($localeCode); ?>">
    <meta property="og:image" content="https://promo.nerp.app/social-preview.png">
    <meta property="og:image:type" content="image/png">
    <?php if ($metaOgImageAlt !== ''): ?>
        <meta property="og:image:alt" content="<?= e($metaOgImageAlt); ?>">
    <?php endif; ?>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($metaOgTitle); ?>">
    <meta name="twitter:description" content="<?= e($metaOgDescription); ?>">
    <meta name="twitter:image" content="https://promo.nerp.app/social-preview.png">
    <?php if ($metaOgImageAlt !== ''): ?>
        <meta name="twitter:image:alt" content="<?= e($metaOgImageAlt); ?>">
    <?php endif; ?>
    <meta name="theme-color" content="#0f172a">

    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="<?= e($favicon); ?>">
    <link rel="stylesheet" href="<?= e(asset('assets/css/app.css')); ?>">
    <!-- Analytics: lightweight dataLayer stub for manual tracking hooks -->
    <script>
        window.dataLayer = window.dataLayer || [];
        function track(event, payload) {
            window.dataLayer.push(Object.assign({ event }, payload || {}));
        }
    </script>
    <!-- Marketing: capture UTM parameters, store them globally, and emit a page_view event -->
    <script>
        (function () {
            const params = new URLSearchParams(window.location.search);
            const utm = {
                utm_source: params.get('utm_source') || '',
                utm_medium: params.get('utm_medium') || '',
                utm_campaign: params.get('utm_campaign') || '',
                utm_content: params.get('utm_content') || '',
                utm_term: params.get('utm_term') || ''
            };
            window.__utm = utm;
            track('page_view', Object.assign({ lang: document.documentElement.lang || '' }, utm));
        })();
    </script>
    <!-- Analytics placeholders: insert GA4 / Yandex Metrica / Meta Pixel tags here when approved -->
    <script>
        document.documentElement.classList.remove('no-js');
    </script>
    <script>
        window.__APP_CONFIG__ = <?= json_encode($clientConfig, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
    </script>
    <?php
    // SEO: Structured data payloads for WebSite, Organization, WebPage, and FAQ.
    $websiteId = 'https://promo.nerp.app/#website';
    $organizationId = 'https://promo.nerp.app/#organization';
    $faqEntities = [];
    if (str_starts_with(strtolower($localeCode), 'ru')) {
        $faqEntities = [
            ['@type' => 'Question', 'name' => 'Что такое nERP?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'nERP — Web3 ERP-конструктор с локальным шифрованием и микроплатежами за операции. Соберите CRM/HR/Склад и запустите пилот за 1 день.']],
            ['@type' => 'Question', 'name' => 'Как быстро запустить CRM/HR/Склад?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Запускаем первый процесс за день: подключаем к узлам nERP, описываем роли, статусы и метрики, фиксируем эффект пилота.']],
            ['@type' => 'Question', 'name' => 'Где хранятся данные nERP?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Данные остаются у вашей команды: действует ролевая модель доступа и локальное шифрование, узлы видят только зашифрованные блоки.']],
            ['@type' => 'Question', 'name' => 'Как работает ролевая модель доступа?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Назначаем роли и политики доступа на уровне операций, журналируем действия и можем отзывать ключи без простоя.']],
            ['@type' => 'Question', 'name' => 'Какие пилоты поддерживает nERP?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Подходит SMB, интеграторам и Web3-командам: собираем CRM, HR и склад, подключаем нужные интеграции и сопровождаем пилоты.']],
            ['@type' => 'Question', 'name' => 'Сколько стоит запуск nERP?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Оплата за реальные операции: микроплатежи в токенах nERP, комфортные условия фиксируем в заявке на пилот.']]
        ];
    } else {
        $faqEntities = [
            ['@type' => 'Question', 'name' => 'What is nERP?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'nERP is a Web3 ERP builder with local encryption, role-based access, and micropayments per operation to launch CRM/HR/Inventory fast.']],
            ['@type' => 'Question', 'name' => 'How fast can we launch CRM/HR/Inventory?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Spin up the first workflow in one day: connect to nERP nodes, map roles and statuses, then measure pilot impact.']],
            ['@type' => 'Question', 'name' => 'Where is nERP data stored?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Data stays under your control with local encryption and role-based policies while nodes only process encrypted payloads.']],
            ['@type' => 'Question', 'name' => 'How does the access model work?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'We enforce granular roles, audit every action, and let you rotate keys without downtime for users.']],
            ['@type' => 'Question', 'name' => 'Who benefits from nERP pilots?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'SMBs, integrators, and Web3 teams that need configurable CRM, HR, and inventory modules with measurable outcomes.']],
            ['@type' => 'Question', 'name' => 'How is nERP priced?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Pricing is usage-based: micropayments per confirmed action with pilot terms captured in the intake form.']]
        ];
    }

    $structuredData = [
        [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            '@id' => $websiteId,
            'name' => 'nERP',
            'url' => 'https://promo.nerp.app/',
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => 'https://promo.nerp.app/search?q={query}',
                'query-input' => 'required name=query',
            ],
        ],
        [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            '@id' => $organizationId,
            'name' => 'nERP',
            'url' => 'https://promo.nerp.app/',
            'logo' => 'https://promo.nerp.app/social-preview.png',
            'sameAs' => ['https://t.me/nerp_app', 'https://x.com/nerp_app'],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'contactType' => 'customer support',
                'email' => 'pilot@nerp.app',
                'areaServed' => ['RU', 'EU', 'US'],
                'availableLanguage' => ['ru', 'en'],
            ],
        ],
        [
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => $metaTitle,
            'inLanguage' => $localeCode,
            'url' => $canonical,
            'isPartOf' => ['@id' => $websiteId],
        ],
        [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $faqEntities,
        ],
    ];
    ?>
    <script type="application/ld+json">
        <?= json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
    </script>
    <script defer src="<?= e(asset('assets/js/app.js')); ?>" type="module"></script>
</head>
<body>
    <div class="bg-root">
        <?php require BASE_PATH . '/views/partials/header.php'; ?>
        <main id="main" tabindex="-1">
            <?= $content; ?>
        </main>
        <?php require BASE_PATH . '/views/partials/footer.php'; ?>
    </div>
    <div class="floating-cta">
        <button class="btn btn-primary" data-floating-cta data-scroll-target="pilotForm" data-track-cta="floating_pilot">
            <span class="icon rocket" aria-hidden="true"></span><?= e($t->get('floating_cta')); ?>
        </button>
    </div>
    <noscript>
        <div class="noscript-banner">
            <?= e($t->get('app.noscript')); ?>
        </div>
    </noscript>
</body>
</html>
