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
        <nav class="nav" aria-label="Main navigation">
            <a href="#for"><?= e($t->get('nav.for')); ?></a>
            <a href="#why"><?= e($t->get('nav.why')); ?></a>
            <a href="#how"><?= e($t->get('nav.how')); ?></a>
            <a href="#outcomes"><?= e($t->get('nav.outcomes')); ?></a>
            <a href="#pilots"><?= e($t->get('nav.pilots')); ?></a>
            <a href="#pricing"><?= e($t->get('nav.pricing')); ?></a>
            <a href="#partners"><?= e($t->get('nav.partners')); ?></a>
            <a href="#faq"><?= e($t->get('nav.faq')); ?></a>
        </nav>
        <div class="actions">
            <div class="lang-switcher" data-language-switcher>
                <label for="language" class="sr-only"><?= e($t->get('language_switcher.label')); ?></label>
                <select id="language" name="language" data-language-select>
                    <?php foreach ($languages as $code => $label): ?>
                        <?php $href = $localeUrls[$code] ?? ('/' . $code . '/'); ?>
                        <option value="<?= e($href); ?>" <?= $code === $currentLocale ? 'selected' : ''; ?>><?= e($label); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <noscript class="lang-switcher-links">
                <?php foreach ($languages as $code => $label): ?>
                    <?php $href = $localeUrls[$code] ?? ('/' . $code . '/'); ?>
                    <a href="<?= e($href); ?>"><?= e($label); ?></a>
                <?php endforeach; ?>
            </noscript>
            <button class="btn btn-ghost" type="button" data-theme-toggle aria-label="<?= e($t->get('app.theme.toggle')); ?>">
                <span class="icon theme" aria-hidden="true"></span>
                <span data-theme-label><?= e($t->get('app.theme.' . ($currentTheme ?? 'light'))); ?></span>
            </button>
            <a class="btn btn-primary" href="#pilots" data-scroll-to-pilots>
                <span class="icon rocket" aria-hidden="true"></span><?= e($t->get('hero.primary_cta')); ?>
            </a>
        </div>
    </div>
</header>
