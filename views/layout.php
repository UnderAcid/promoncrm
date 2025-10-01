<?php
/** @var App\Localization\Translator $t */
/** @var string $content */
/** @var array<string, string> $languages */
/** @var string $currentLocale */
/** @var string $currentTheme */
/** @var array<string, mixed> $clientConfig */
/** @var string[] $themes */
/** @var array<string, string> $localeUrls */

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
?>
<!DOCTYPE html>
<html lang="<?= e($localeCode); ?>" data-theme="<?= e($currentTheme); ?>" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title><?= e($t->get('meta.title')); ?></title>
    <meta name="description" content="<?= e($t->get('meta.description')); ?>">
    <meta name="keywords" content="<?= e($t->get('meta.keywords')); ?>">
    <link rel="canonical" href="<?= e($canonical); ?>">
    <?php foreach ($localeUrls as $code => $path): ?>
        <link rel="alternate" hreflang="<?= e($code); ?>" href="<?= e($scheme . '://' . $host . $path); ?>">
    <?php endforeach; ?>
    <link rel="alternate" hreflang="x-default" href="<?= e($scheme . '://' . $host . '/'); ?>">
    <meta property="og:title" content="<?= e($t->get('meta.og_title')); ?>">
    <meta property="og:description" content="<?= e($t->get('meta.og_description')); ?>">
    <meta property="og:url" content="<?= e($canonical); ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="<?= e($localeCode); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="theme-color" content="#0f172a">

    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= e(asset('assets/css/app.css')); ?>">
    <script>
        document.documentElement.classList.remove('no-js');
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
        <button class="btn btn-primary" data-floating-cta data-scroll-target="pilotForm">
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
