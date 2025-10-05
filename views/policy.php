<?php
/** @var App\Localization\Translator $t */
/** @var string $currentLocale */

$policy = $t->get('policy');
$policy = is_array($policy) ? $policy : [];

$eyebrow = (string) ($policy['eyebrow'] ?? '');
$title = (string) ($policy['title'] ?? $t->get('policy.meta.title', [], $t->get('app.name')));
$intro = (string) ($policy['intro'] ?? '');
$updatedAt = (string) ($policy['updated_at'] ?? '');

$summary = is_array($policy['summary'] ?? null) ? $policy['summary'] : [];
$summaryTitle = (string) ($summary['title'] ?? '');
$summaryItems = [];
if (isset($summary['items']) && is_array($summary['items'])) {
    foreach ($summary['items'] as $summaryItem) {
        $text = is_string($summaryItem) ? trim($summaryItem) : (string) ($summaryItem['text'] ?? '');
        if ($text !== '') {
            $summaryItems[] = $text;
        }
    }
}

$sections = [];
if (isset($policy['sections']) && is_array($policy['sections'])) {
    foreach ($policy['sections'] as $section) {
        if (!is_array($section)) {
            continue;
        }
        $sectionTitle = (string) ($section['title'] ?? '');
        $sectionIntro = (string) ($section['intro'] ?? '');
        $entries = [];
        if (isset($section['items']) && is_array($section['items'])) {
            foreach ($section['items'] as $item) {
                if (!is_array($item)) {
                    continue;
                }
                $itemTitle = (string) ($item['title'] ?? '');
                $itemDesc = (string) ($item['desc'] ?? '');
                $itemBullets = [];
                if (isset($item['bullets']) && is_array($item['bullets'])) {
                    foreach ($item['bullets'] as $bullet) {
                        $bulletText = is_string($bullet) ? trim($bullet) : '';
                        if ($bulletText !== '') {
                            $itemBullets[] = $bulletText;
                        }
                    }
                }

                if ($itemTitle === '' && $itemDesc === '' && $itemBullets === []) {
                    continue;
                }

                $entries[] = [
                    'title' => $itemTitle,
                    'desc' => $itemDesc,
                    'bullets' => $itemBullets,
                ];
            }
        }

        if ($sectionTitle === '' && $sectionIntro === '' && $entries === []) {
            continue;
        }

        $sections[] = [
            'title' => $sectionTitle,
            'intro' => $sectionIntro,
            'items' => $entries,
        ];
    }
}

$contact = is_array($policy['contact'] ?? null) ? $policy['contact'] : [];
$contactTitle = (string) ($contact['title'] ?? '');
$contactDesc = (string) ($contact['desc'] ?? '');
$contactEmail = (string) ($contact['email'] ?? '');
$contactHours = (string) ($contact['hours'] ?? '');
?>

<section class="container policy-hero">
    <div class="policy-hero-inner">
        <?php if ($eyebrow !== ''): ?>
            <div class="eyebrow"><?= e($eyebrow); ?></div>
        <?php endif; ?>
        <h1 class="h1 policy-title"><?= e($title); ?></h1>
        <?php if ($intro !== ''): ?>
            <p class="lead policy-intro"><?= e($intro); ?></p>
        <?php endif; ?>
        <?php if ($updatedAt !== ''): ?>
            <p class="policy-updated muted small"><?= e($updatedAt); ?></p>
        <?php endif; ?>
    </div>
</section>

<?php if ($summaryItems !== []): ?>
    <section class="container policy-summary">
        <?php if ($summaryTitle !== ''): ?>
            <h2 class="h3 policy-summary-title"><?= e($summaryTitle); ?></h2>
        <?php endif; ?>
        <ul class="policy-summary-grid">
            <?php foreach ($summaryItems as $item): ?>
                <li>
                    <span><?= e($item); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php endif; ?>

<section class="container policy-sections">
    <?php foreach ($sections as $section): ?>
        <section class="policy-section">
            <?php if ($section['title'] !== ''): ?>
                <h2 class="h3 policy-section-title"><?= e($section['title']); ?></h2>
            <?php endif; ?>
            <?php if ($section['intro'] !== ''): ?>
                <p class="policy-section-intro"><?= e($section['intro']); ?></p>
            <?php endif; ?>
            <?php if ($section['items'] !== []): ?>
                <ul class="policy-section-list">
                    <?php foreach ($section['items'] as $item): ?>
                        <li>
                            <?php if ($item['title'] !== ''): ?>
                                <h3><?= e($item['title']); ?></h3>
                            <?php endif; ?>
                            <?php if ($item['desc'] !== ''): ?>
                                <p><?= e($item['desc']); ?></p>
                            <?php endif; ?>
                            <?php if ($item['bullets'] !== []): ?>
                                <ul>
                                    <?php foreach ($item['bullets'] as $bullet): ?>
                                        <li><?= e($bullet); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>
    <?php endforeach; ?>

    <?php if ($contactTitle !== '' || $contactDesc !== '' || $contactEmail !== '' || $contactHours !== ''): ?>
        <section class="policy-contact card">
            <?php if ($contactTitle !== ''): ?>
                <h2 class="h3"><?= e($contactTitle); ?></h2>
            <?php endif; ?>
            <?php if ($contactDesc !== ''): ?>
                <p><?= e($contactDesc); ?></p>
            <?php endif; ?>
            <?php if ($contactEmail !== ''): ?>
                <p class="policy-contact-email">
                    <span class="icon mail" aria-hidden="true"></span>
                    <a href="mailto:<?= e($contactEmail); ?>"><?= e($contactEmail); ?></a>
                </p>
            <?php endif; ?>
            <?php if ($contactHours !== ''): ?>
                <p class="muted small policy-contact-hours"><?= e($contactHours); ?></p>
            <?php endif; ?>
        </section>
    <?php endif; ?>
</section>
