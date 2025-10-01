<?php
/** @var App\Localization\Translator $t */
/** @var array<int, array{code: string, label: string, url: string, active: bool}> $languages */
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
            <a href="#pricing"><?= e($t->get('nav.pricing')); ?></a>
            <a href="#partners"><?= e($t->get('nav.partners')); ?></a>
            <a href="#pilot"><?= e($t->get('nav.pilot')); ?></a>
            <a href="#faq"><?= e($t->get('nav.faq')); ?></a>
        </nav>
        <div class="actions">
            <form class="lang-switcher" method="get" data-language-switcher>
                <label for="language" class="sr-only"><?= e($t->get('language_switcher.label')); ?></label>
                <select id="language" name="lang">
                    <?php foreach ($languages as $option): ?>
                        <option
                            value="<?= e($option['code']); ?>"
                            data-url="<?= e($option['url']); ?>"
                            <?= $option['active'] ? 'selected' : ''; ?>
                        ><?= e($option['label']); ?></option>
                    <?php endforeach; ?>
                </select>
            </form>
            <button class="btn btn-ghost" type="button" data-theme-toggle aria-label="<?= e($t->get('app.theme.toggle')); ?>">
                <span class="icon theme" aria-hidden="true"></span>
                <span data-theme-label><?= e($t->get('app.theme.' . ($currentTheme ?? 'light'))); ?></span>
            </button>
            <a class="btn btn-primary" href="#pilot">
                <span class="icon rocket" aria-hidden="true"></span><?= e($t->get('hero.primary_cta')); ?>
            </a>
        </div>
    </div>
</header>
