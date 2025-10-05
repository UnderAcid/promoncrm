<?php
/** @var App\Localization\Translator $t */
/** @var string $currentLocale */

$policy = $t->get('policy');
$policy = is_array($policy) ? $policy : [];

$eyebrow = (string) ($policy['eyebrow'] ?? '');
$title = (string) ($policy['title'] ?? '');
$intro = (string) ($policy['intro'] ?? '');
$footer = (string) ($policy['footer'] ?? '');

$sectionsRaw = is_array($policy['sections'] ?? null) ? $policy['sections'] : [];
$sections = [];

foreach ($sectionsRaw as $section) {
    if (!is_array($section)) {
        continue;
    }

    $sectionTitle = (string) ($section['title'] ?? '');
    $items = is_array($section['items'] ?? null) ? array_values(array_filter($section['items'], static function ($item): bool {
        return is_string($item) && trim($item) !== '';
    })) : [];

    if ($sectionTitle === '' && $items === []) {
        continue;
    }

    $sections[] = [
        'title' => $sectionTitle,
        'items' => $items,
    ];
}
?>
<section class="container policy-page">
    <header class="policy-header">
        <?php if ($eyebrow !== ''): ?>
            <div class="eyebrow"><?= e($eyebrow); ?></div>
        <?php endif; ?>
        <?php if ($title !== ''): ?>
            <h1 class="h1"><?= e($title); ?></h1>
        <?php endif; ?>
        <?php if ($intro !== ''): ?>
            <p class="lead"><?= e($intro); ?></p>
        <?php endif; ?>
    </header>

    <?php if ($sections !== []): ?>
        <div class="policy-grid">
            <?php foreach ($sections as $section): ?>
                <article class="card policy-card">
                    <?php if ($section['title'] !== ''): ?>
                        <h2 class="policy-card-title"><?= e($section['title']); ?></h2>
                    <?php endif; ?>
                    <?php if ($section['items'] !== []): ?>
                        <div class="policy-card-body">
                            <?php foreach ($section['items'] as $item): ?>
                                <p><?= e($item); ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($footer !== ''): ?>
        <p class="policy-footnote"><?= e($footer); ?></p>
    <?php endif; ?>
</section>
