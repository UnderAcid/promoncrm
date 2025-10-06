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
$host = $_SERVER['HTTP_HOST'] ?? 'promo.nerp.app';
if ($host === 'localhost' || str_starts_with($host, '127.') || str_starts_with($host, '0.0.0.0')) {
    $host = 'promo.nerp.app';
}
if ($host === 'nerp.app') {
    $host = 'promo.nerp.app';
}
if ($host === 'promo.nerp.app') {
    $scheme = 'https';
}
$uri = strtok($_SERVER['REQUEST_URI'] ?? '/', '?') ?: '/';
$canonical = $scheme . '://' . $host . $uri;
$localeCode = (string) $t->get('app.locale_code', [], $currentLocale);
$heroIllustration = asset('assets/img/hero-illustration.svg');
$siteOrigin = 'https://promo.nerp.app';
$ogImageUrl = $siteOrigin . '/social-preview.png';
$favicon = asset('assets/img/favicon.svg');
$ogImageAltDefault = (string) ($t->get('meta.og_image_alt') ?? '');
$pageMeta = is_array($pageMeta ?? null) ? $pageMeta : [];
$metaTitle = (string) ($pageMeta['title'] ?? $t->get('meta.title'));
$metaDescription = (string) ($pageMeta['description'] ?? $t->get('meta.description'));
$metaKeywords = (string) ($pageMeta['keywords'] ?? $t->get('meta.keywords'));
$metaOgTitle = (string) ($pageMeta['og_title'] ?? $t->get('meta.og_title'));
$metaOgDescription = (string) ($pageMeta['og_description'] ?? $t->get('meta.og_description'));
$metaOgImageAlt = (string) ($pageMeta['og_image_alt'] ?? $ogImageAltDefault);
$ogLocale = str_replace('-', '_', $localeCode);
$schemaConfig = $t->get('schema');
if (!is_array($schemaConfig)) {
    $schemaConfig = [];
}
$webpageName = (string) ($schemaConfig['webpage_name'] ?? $metaTitle);
$webpageDescription = (string) ($schemaConfig['webpage_description'] ?? $metaDescription);
$schemaFaqRaw = $schemaConfig['faq'] ?? $t->get('faq.items');
$schemaFaq = [];
if (is_array($schemaFaqRaw)) {
    foreach ($schemaFaqRaw as $faqItem) {
        if (!is_array($faqItem)) {
            continue;
        }

        $question = trim((string) ($faqItem['question'] ?? ''));
        $answer = trim((string) ($faqItem['answer'] ?? ''));

        if ($question === '' || $answer === '') {
            continue;
        }

        $schemaFaq[] = [
            '@type' => 'Question',
            'name' => $question,
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $answer,
            ],
        ];
    }
}
$websiteId = $siteOrigin . '/#website';
$organizationId = $siteOrigin . '/#organization';
$structuredWebsite = [
    '@context' => 'https://schema.org',
    '@type' => 'WebSite',
    '@id' => $websiteId,
    'name' => 'nERP',
    'url' => $siteOrigin . '/',
    'potentialAction' => [
        '@type' => 'SearchAction',
        'target' => 'https://promo.nerp.app/search?q={query}',
        'query-input' => 'required name=query',
    ],
];
$structuredOrganization = [
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    '@id' => $organizationId,
    'name' => 'nERP',
    'url' => $siteOrigin . '/',
    'logo' => $ogImageUrl,
    'sameAs' => [
        'https://t.me/nerp_app',
        'https://x.com/nerp_app',
    ],
    'contactPoint' => [
        [
            '@type' => 'ContactPoint',
            'contactType' => 'sales',
            'email' => 'pilot@nerp.app',
            'areaServed' => ['RU', 'EN'],
            'availableLanguage' => ['ru', 'en'],
        ],
    ],
];
$structuredWebPage = [
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    '@id' => $canonical . '#webpage',
    'name' => $webpageName,
    'inLanguage' => $localeCode,
    'url' => $canonical,
    'isPartOf' => [
        '@id' => $websiteId,
    ],
    'description' => $webpageDescription,
];
$primaryImage = [
    '@type' => 'ImageObject',
    'url' => $ogImageUrl,
];
if ($metaOgImageAlt !== '') {
    $primaryImage['caption'] = $metaOgImageAlt;
}
$structuredWebPage['primaryImageOfPage'] = $primaryImage;
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
    <meta property="og:title" content="<?= e($metaOgTitle); ?>">
    <meta property="og:description" content="<?= e($metaOgDescription); ?>">
    <meta property="og:url" content="<?= e($canonical); ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="nERP">
    <meta property="og:locale" content="<?= e($ogLocale); ?>">
    <meta property="og:image" content="<?= e($ogImageUrl); ?>">
    <meta property="og:image:type" content="image/png">
    <?php if ($metaOgImageAlt !== ''): ?>
        <meta property="og:image:alt" content="<?= e($metaOgImageAlt); ?>">
    <?php endif; ?>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($metaOgTitle); ?>">
    <meta name="twitter:description" content="<?= e($metaOgDescription); ?>">
    <meta name="twitter:image" content="<?= e($ogImageUrl); ?>">
    <?php if ($metaOgImageAlt !== ''): ?>
        <meta name="twitter:image:alt" content="<?= e($metaOgImageAlt); ?>">
    <?php endif; ?>
    <meta name="theme-color" content="#0f172a">

    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="<?= e($favicon); ?>">
    <link rel="stylesheet" href="<?= e(asset('assets/css/app.css')); ?>">
    <!-- JSON-LD: WebSite entity for search engines -->
    <script type="application/ld+json">
        <?= json_encode($structuredWebsite, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
    </script>
    <!-- JSON-LD: Organization profile with contact points -->
    <script type="application/ld+json">
        <?= json_encode($structuredOrganization, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
    </script>
    <!-- JSON-LD: WebPage description scoped to the current locale -->
    <script type="application/ld+json">
        <?= json_encode($structuredWebPage, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
    </script>
    <?php if ($schemaFaq !== []): ?>
        <!-- JSON-LD: FAQPage to expose pilot Q&A -->
        <script type="application/ld+json">
            <?= json_encode([
                '@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                'mainEntity' => $schemaFaq,
            ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
        </script>
    <?php endif; ?>
    <!-- Analytics placeholders: add GA4 / Meta Pixel / Yandex Metrica snippets here when approved -->
    <script>
        document.documentElement.classList.remove('no-js');
    </script>
    <!-- Lightweight dataLayer bootstrap for custom tracking -->
    <script>
        window.dataLayer = window.dataLayer || [];
        function track(event, payload) {
            if (!event) {
                return;
            }
            var data = { event: event };
            if (payload && typeof payload === 'object') {
                for (var key in payload) {
                    if (Object.prototype.hasOwnProperty.call(payload, key) && payload[key] !== undefined) {
                        data[key] = payload[key];
                    }
                }
            }
            window.dataLayer.push(data);
        }
    </script>
    <!-- UTM capture for CTA enrichment and attribution -->
    <script>
        (function () {
            var params = new URLSearchParams(window.location.search);
            var utm = {
                utm_source: params.get('utm_source') || '',
                utm_medium: params.get('utm_medium') || '',
                utm_campaign: params.get('utm_campaign') || '',
                utm_content: params.get('utm_content') || '',
                utm_term: params.get('utm_term') || ''
            };
            window.__utm = utm;
            var pagePayload = {
                lang: document.documentElement.lang || ''
            };
            for (var key in utm) {
                if (Object.prototype.hasOwnProperty.call(utm, key) && utm[key]) {
                    pagePayload[key] = utm[key];
                }
            }
            if (typeof track === 'function') {
                track('page_view', pagePayload);
            } else {
                var fallbackPayload = { event: 'page_view' };
                for (var payloadKey in pagePayload) {
                    if (Object.prototype.hasOwnProperty.call(pagePayload, payloadKey)) {
                        fallbackPayload[payloadKey] = pagePayload[payloadKey];
                    }
                }
                window.dataLayer.push(fallbackPayload);
            }
        })();
    </script>
    <script>
        window.__APP_CONFIG__ = <?= json_encode($clientConfig, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
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
        <button
            class="btn btn-primary"
            data-floating-cta
            data-scroll-target="apply"
            data-track-event="cta_click"
            data-track-label="floating_cta"
            data-track-location="floating"
        >
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
