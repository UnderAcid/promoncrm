<?php
/** @var App\Localization\Translator $t */
/** @var array<string, string> $languages */
/** @var string $currentLocale */
/** @var string[] $themes */
/** @var string $currentTheme */

$currentLanguageLabel = $languages[$currentLocale] ?? strtoupper($currentLocale);
$currentThemeLabel = (string) ($t->get('app.theme.' . $currentTheme) ?? '');
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
            <div class="preferences">
                <div class="lang-switcher" data-language-switcher>
                    <button class="preference-trigger" type="button" data-language-toggle aria-haspopup="true" aria-expanded="false" aria-label="<?= e($t->get('language_switcher.label')); ?>">
                        <span class="preference-icon icon globe" aria-hidden="true"></span>
                        <span class="preference-copy">
                            <span class="preference-label"><?= e($t->get('app.language_label')); ?></span>
                            <span class="preference-value"><?= e($currentLanguageLabel); ?></span>
                        </span>
                        <span class="preference-caret icon chevron" aria-hidden="true"></span>
                    </button>
                    <ul class="lang-menu" data-language-menu>
                        <?php foreach ($languages as $code => $label): ?>
                            <?php if ($code === $currentLocale) { continue; } ?>
                            <?php $href = $localeUrls[$code] ?? ('/' . $code . '/'); ?>
                            <li>
                                <a href="<?= e($href); ?>" data-language-option><?= e($label); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <noscript class="lang-switcher-links">
                    <?php foreach ($languages as $code => $label): ?>
                        <?php $href = $localeUrls[$code] ?? ('/' . $code . '/'); ?>
                        <a href="<?= e($href); ?>"><?= e($label); ?></a>
                    <?php endforeach; ?>
                </noscript>
                <button class="theme-toggle" type="button" data-theme-toggle aria-label="<?= e($t->get('app.theme.toggle')); ?>">
                    <span class="theme-toggle-visual" aria-hidden="true">
                        <span class="theme-toggle-icon theme-toggle-icon-sun">☀️</span>
                        <span class="theme-toggle-icon theme-toggle-icon-moon">🌙</span>
                        <span class="theme-toggle-thumb"></span>
                    </span>
                    <span class="preference-copy">
                        <span class="preference-label"><?= e($t->get('app.theme.label')); ?></span>
                        <span class="preference-value" data-theme-label><?= e($currentThemeLabel); ?></span>
                    </span>
                </button>
            </div>
            <a class="btn btn-primary" href="#pilots" data-scroll-to-pilots>
                <span class="icon rocket" aria-hidden="true"></span><?= e($t->get('hero.primary_cta')); ?>
            </a>
        </div>
    </div>
</header>
