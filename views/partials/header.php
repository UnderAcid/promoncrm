<?php
/** @var App\Localization\Translator $t */
/** @var array<string, string> $languages */
/** @var string $currentLocale */
/** @var string[] $themes */
?>
<header class="header" data-header>
    <div class="container header-inner">
        <a class="brand" href="#main">
            <span class="brand-mark" aria-hidden="true">n</span>
            <span class="brand-name"><?= e($t->get('app.name')); ?></span>
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
            <a href="#for"><?= e($t->get('nav.for')); ?></a>
            <a href="#why"><?= e($t->get('nav.why')); ?></a>
            <a href="#pricing"><?= e($t->get('nav.pricing')); ?></a>
            <a href="#pilots"><?= e($t->get('nav.pilots')); ?></a>
        </nav>
        <div class="actions">
            <div class="icon-switchers">
                <button
                    class="icon-button lang-button js-only"
                    type="button"
                    data-language-toggle
                    data-locale-code="<?= e(strtoupper($currentLocale)); ?>"
                    aria-label="<?= e($t->get('language_switcher.label')); ?>"
                >
                    <span class="lang-button-face" aria-hidden="true"><?= e(strtoupper($currentLocale)); ?></span>
                </button>
                <noscript class="lang-switcher-links">
                    <?php foreach ($languages as $code => $label): ?>
                        <?php $href = $localeUrls[$code] ?? ('/' . $code . '/'); ?>
                        <a href="<?= e($href); ?>"><?= e($label); ?></a>
                    <?php endforeach; ?>
                </noscript>
                <button
                    class="icon-button theme-button js-only"
                    type="button"
                    data-theme-toggle
                    data-theme="<?= e($currentTheme); ?>"
                    aria-label="<?= e($t->get('app.theme.toggle')); ?>"
                >
                    <span class="icon sun" data-theme-icon="light" aria-hidden="true"></span>
                    <span class="icon moon" data-theme-icon="dark" aria-hidden="true"></span>
                </button>
            </div>
            <a class="btn btn-primary" href="#pilots" data-scroll-to-pilots>
                <span class="icon rocket" aria-hidden="true"></span><?= e($t->get('hero.primary_cta')); ?>
            </a>
        </div>
    </div>
</header>
