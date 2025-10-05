<?php
/** @var App\Localization\Translator $t */
/** @var array<string, mixed> $policy */

$policyData = is_array($policy ?? null) ? $policy : [];
$eyebrow = (string) ($policyData['eyebrow'] ?? '');
$title = (string) ($policyData['title'] ?? '');
$intro = (string) ($policyData['intro'] ?? '');
$updated = (string) ($policyData['updated'] ?? '');
$contact = (string) ($policyData['contact'] ?? '');
$sectionsRaw = is_array($policyData['sections'] ?? null) ? $policyData['sections'] : [];
$sections = [];

foreach ($sectionsRaw as $section) {
    if (!is_array($section)) {
        continue;
    }

    $sectionTitle = (string) ($section['title'] ?? '');
    $paragraphs = [];
    $paragraphsRaw = $section['paragraphs'] ?? [];
    if (is_array($paragraphsRaw)) {
        foreach ($paragraphsRaw as $paragraph) {
            $text = trim((string) $paragraph);
            if ($text !== '') {
                $paragraphs[] = $text;
            }
        }
    }

    $bullets = [];
    $bulletsRaw = $section['bullets'] ?? [];
    if (is_array($bulletsRaw)) {
        foreach ($bulletsRaw as $bullet) {
            $text = trim((string) $bullet);
            if ($text !== '') {
                $bullets[] = $text;
            }
        }
    }

    if ($sectionTitle === '' && $paragraphs === [] && $bullets === []) {
        continue;
    }

    $sections[] = [
        'title' => $sectionTitle,
        'paragraphs' => $paragraphs,
        'bullets' => $bullets,
    ];
}
?>
<section class="container policy-page">
    <header class="policy-hero">
        <?php if ($eyebrow !== ''): ?>
            <div class="eyebrow"><?= e($eyebrow); ?></div>
        <?php endif; ?>
        <?php if ($title !== ''): ?>
            <h1 class="policy-title"><?= e($title); ?></h1>
        <?php endif; ?>
        <?php if ($intro !== ''): ?>
            <p class="lead policy-intro"><?= e($intro); ?></p>
        <?php endif; ?>
        <?php if ($updated !== ''): ?>
            <p class="muted policy-updated"><?= e($updated); ?></p>
        <?php endif; ?>
    </header>

    <?php if ($sections !== []): ?>
        <div class="policy-sections">
            <?php foreach ($sections as $section): ?>
                <article class="card policy-section">
                    <?php if ($section['title'] !== ''): ?>
                        <h2 class="policy-section-title"><?= e($section['title']); ?></h2>
                    <?php endif; ?>
                    <?php foreach ($section['paragraphs'] as $paragraph): ?>
                        <p><?= e($paragraph); ?></p>
                    <?php endforeach; ?>
                    <?php if ($section['bullets'] !== []): ?>
                        <ul class="policy-list">
                            <?php foreach ($section['bullets'] as $bullet): ?>
                                <li><?= e($bullet); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($contact !== ''): ?>
        <aside class="card policy-contact">
            <h2 class="policy-contact-title"><?= e($t->get('policy.contact_title')); ?></h2>
            <p><?= e($contact); ?></p>
        </aside>
    <?php endif; ?>
</section>
