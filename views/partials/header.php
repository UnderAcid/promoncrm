<?php
/** @var App\Localization\Translator $t */
/** @var array<string, string> $languages */
/** @var string $currentLocale */
/** @var string[] $themes */
/** @var string $homeUrl */
?>
<?php
$localeCycle = [];
foreach ($languages as $code => $label) {
    $localeCycle[] = [
        'code' => $code,
        'label' => $label,
        'href' => $localeUrls[$code] ?? ('/' . $code . '/'),
    ];
}

$localeCycleJson = json_encode($localeCycle, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?: '[]';
$languageIconCode = strtolower((string) $currentLocale);
$languageIconCode = preg_replace('/[^a-z]/', '', $languageIconCode);
if (strlen($languageIconCode) > 2) {
    $languageIconCode = substr($languageIconCode, 0, 2);
}
if ($languageIconCode === '') {
    $languageIconCode = 'globe';
}
$languageIconClass = in_array($languageIconCode, ['ru', 'en'], true) ? 'flag-' . $languageIconCode : 'globe';
$logoPath = asset('assets/img/logo-nerp.svg');
?>
<header class="header" data-header>
    <div class="container header-inner">
        <a class="brand" href="<?= e($homeUrl); ?>">
            <span class="brand-logo" aria-hidden="true">
                <img src="<?= e($logoPath); ?>" alt="nERP logo">
            </span>
            <span class="brand-wordmark">
                <span class="brand-name"><?= e($t->get('app.name')); ?></span>
                <?php $tagline = (string) ($t->get('app.tagline') ?? ''); ?>
                <?php if ($tagline !== ''): ?>
                    <span class="brand-tagline"><?= e($tagline); ?></span>
                <?php endif; ?>
            </span>
        </a>
        <button class="nav-toggle" type="button" data-nav-toggle aria-controls="mainNav" aria-expanded="false">
            <span class="nav-toggle-box" aria-hidden="true">
                <span class="nav-toggle-bar"></span>
                <span class="nav-toggle-bar"></span>
                <span class="nav-toggle-bar"></span>
            </span>
            <span class="sr-only"><?= e($t->get('nav.toggle')); ?></span>
        </button>
        <nav class="nav" id="mainNav" aria-label="Main navigation" data-nav>
            <a href="<?= e($homeUrl); ?>#for"><?= e($t->get('nav.for')); ?></a>
            <a href="<?= e($homeUrl); ?>#why"><?= e($t->get('nav.why')); ?></a>
            <a href="<?= e($homeUrl); ?>#pricing"><?= e($t->get('nav.pricing')); ?></a>
            <a href="<?= e($homeUrl); ?>#pilots"><?= e($t->get('nav.pilots')); ?></a>
        </nav>
        <div class="actions">
            <div class="icon-switchers">
                <button
                    class="icon-toggle"
                    type="button"
                    data-language-button
                    data-current-locale="<?= e($currentLocale); ?>"
                    data-label="<?= e($t->get('language_switcher.label')); ?>"
                    data-locale-cycle='<?= e($localeCycleJson); ?>'
                >
                    <span class="icon <?= e($languageIconClass); ?>" data-language-icon aria-hidden="true"></span>
                    <span class="sr-only"><?= e($t->get('language_switcher.label')); ?></span>
                </button>
                <noscript class="lang-links">
                    <?php foreach ($localeCycle as $entry): ?>
                        <a href="<?= e($entry['href']); ?>"><?= e($entry['label']); ?></a>
                    <?php endforeach; ?>
                </noscript>
                <button
                    class="icon-toggle"
                    type="button"
                    data-theme-toggle
                    aria-label="<?= e($t->get('app.theme.toggle')); ?>"
                    aria-pressed="<?= $currentTheme === 'dark' ? 'true' : 'false'; ?>"
                >
                    <span class="icon <?= $currentTheme === 'dark' ? 'moon' : 'sun'; ?>" data-theme-icon aria-hidden="true"></span>
                    <span class="sr-only"><?= e($t->get('app.theme.toggle')); ?></span>
                </button>
            </div>
            <a class="btn btn-primary" href="<?= e($homeUrl); ?>#pilots" data-scroll-to-pilots>
                <span class="icon rocket" aria-hidden="true"></span><?= e($t->get('hero.primary_cta')); ?>
            </a>
        </div>
    </div>
</header>
