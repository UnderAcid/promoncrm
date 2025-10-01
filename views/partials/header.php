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
            <a href="#faq"><?= e($t->get('nav.faq')); ?></a>
        </nav>
        <div class="actions">
            <?php
            $alternateLanguages = array_filter(
                $languages,
                static fn (string $code): bool => $code !== $currentLocale,
                ARRAY_FILTER_USE_KEY
            );
            ?>
            <?php if ($alternateLanguages !== []): ?>
                <div class="lang-switcher" data-language-switcher>
                    <button class="icon-button" type="button" data-language-trigger aria-haspopup="true" aria-expanded="false">
                        <span class="icon globe" aria-hidden="true"></span>
                        <span class="sr-only"><?= e($t->get('language_switcher.label')); ?></span>
                    </button>
                    <ul class="lang-menu" data-language-menu role="menu">
                        <?php foreach ($alternateLanguages as $code => $label): ?>
                            <?php $href = $localeUrls[$code] ?? ('/' . $code . '/'); ?>
                            <li role="none">
                                <a role="menuitem" href="<?= e($href); ?>" data-language-option data-locale="<?= e($code); ?>"><?= e($label); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <noscript class="lang-switcher-links">
                <?php foreach ($languages as $code => $label): ?>
                    <?php $href = $localeUrls[$code] ?? ('/' . $code . '/'); ?>
                    <a href="<?= e($href); ?>"><?= e($label); ?></a>
                <?php endforeach; ?>
            </noscript>
            <button class="icon-button" type="button" data-theme-toggle aria-label="<?= e($t->get('app.theme.toggle')); ?>">
                <span class="icon theme" aria-hidden="true"></span>
                <span class="sr-only" data-theme-label><?= e($t->get('app.theme.' . ($currentTheme ?? 'light'))); ?></span>
            </button>
            <a class="btn btn-primary" href="#pilots" data-scroll-to-pilots>
                <span class="icon rocket" aria-hidden="true"></span><?= e($t->get('hero.primary_cta')); ?>
            </a>
        </div>
    </div>
</header>
