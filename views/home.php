<?php
/** @var App\Localization\Translator $t */
/** @var string $currentLocale */

$hero = $t->get('hero');
$heroHighlights = [];
if (is_array($hero) && isset($hero['highlights']) && is_array($hero['highlights'])) {
    foreach ($hero['highlights'] as $highlight) {
        $highlightText = trim((string) $highlight);
        if ($highlightText !== '') {
            $heroHighlights[] = $highlightText;
        }
    }
}

$pilot = $t->get('pilot');
$pilotBenefits = [];
if (is_array($pilot) && isset($pilot['benefits']) && is_array($pilot['benefits'])) {
    foreach ($pilot['benefits'] as $benefit) {
        if (!is_array($benefit)) {
            continue;
        }
        $title = trim((string) ($benefit['title'] ?? ''));
        $desc = trim((string) ($benefit['desc'] ?? ''));
        if ($title === '' && $desc === '') {
            continue;
        }
        $pilotBenefits[] = [
            'title' => $title,
            'desc' => $desc,
        ];
    }
}

$infographic = $t->get('infographic');
$infographicSteps = [];
if (is_array($infographic) && isset($infographic['steps']) && is_array($infographic['steps'])) {
    foreach ($infographic['steps'] as $step) {
        if (!is_array($step)) {
            continue;
        }
        $title = trim((string) ($step['title'] ?? ''));
        $desc = trim((string) ($step['desc'] ?? ''));
        if ($title === '' && $desc === '') {
            continue;
        }
        $infographicSteps[] = [
            'title' => $title,
            'desc' => $desc,
        ];
    }
}

$comparison = $t->get('comparison');
$beforePoints = [];
$afterPoints = [];
$beforeTitle = '';
$afterTitle = '';
if (is_array($comparison)) {
    $beforeTitle = trim((string) ($comparison['before']['title'] ?? ''));
    $afterTitle = trim((string) ($comparison['after']['title'] ?? ''));

    $beforeRaw = $comparison['before']['points'] ?? [];
    if (is_array($beforeRaw)) {
        foreach ($beforeRaw as $point) {
            $text = trim((string) $point);
            if ($text !== '') {
                $beforePoints[] = $text;
            }
        }
    }

    $afterRaw = $comparison['after']['points'] ?? [];
    if (is_array($afterRaw)) {
        foreach ($afterRaw as $point) {
            $text = trim((string) $point);
            if ($text !== '') {
                $afterPoints[] = $text;
            }
        }
    }
}

$form = $t->get('form');
$formFields = [];
if (is_array($form) && isset($form['fields']) && is_array($form['fields'])) {
    foreach ($form['fields'] as $name => $field) {
        if (!is_array($field)) {
            continue;
        }
        $label = trim((string) ($field['label'] ?? ''));
        $placeholder = trim((string) ($field['placeholder'] ?? ''));
        $type = trim((string) ($field['type'] ?? ''));
        $formFields[$name] = [
            'label' => $label,
            'placeholder' => $placeholder,
            'type' => $type !== '' ? $type : 'text',
        ];
    }
}

$urgency = $t->get('urgency');
$deadlineDate = '';
$urgencyText = '';
if (is_array($urgency)) {
    $deadlineDate = trim((string) ($urgency['date'] ?? ''));
    $urgencyText = (string) $t->get('urgency.text', ['date' => $deadlineDate]);
}

$ctaRepeat = (string) ($t->get('cta_repeat', [], $t->get('hero.primary_cta')));
?>
<section class="section hero-section" id="hero" data-track-section="hero">
    <div class="container hero-grid">
        <div class="hero-copy">
            <p class="eyebrow"><?= e($t->get('app.tagline')); ?></p>
            <h1 class="h1"><?= e($t->get('hero.title')); ?></h1>
            <p class="lead"><?= e($t->get('hero.lead')); ?></p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="#apply" data-scroll-target="apply">
                    <?= e($t->get('hero.primary_cta')); ?>
                </a>
            </div>
            <?php if ($heroHighlights !== []): ?>
                <ul class="hero-highlights" aria-label="<?= e($t->get('hero.highlights_label', [], 'Highlights')); ?>">
                    <?php foreach ($heroHighlights as $highlight): ?>
                        <li>
                            <span class="icon-dot" aria-hidden="true"></span>
                            <?= e($highlight); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
        <div class="hero-visual" aria-hidden="true">
            <div class="hero-visual-card">
                <div class="hero-visual-ring"></div>
                <div class="hero-visual-core">nERP</div>
                <div class="hero-visual-list">
                    <?php foreach ($infographicSteps as $step): ?>
                        <div class="hero-visual-item">
                            <span><?= e($step['title']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section pilot-section" id="pilot" data-track-section="pilot">
    <div class="container">
        <h2 class="h2"><?= e($t->get('pilot.title')); ?></h2>
        <p class="muted"><?= e($t->get('pilot.subtitle')); ?></p>
        <?php if ($pilotBenefits !== []): ?>
            <div class="pilot-benefits">
                <?php foreach ($pilotBenefits as $benefit): ?>
                    <article class="benefit-card">
                        <h3><?= e($benefit['title']); ?></h3>
                        <p><?= e($benefit['desc']); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<section class="section infographic-section" id="how" data-track-section="how">
    <div class="container">
        <h2 class="h2"><?= e($t->get('infographic.title')); ?></h2>
        <?php if ($infographicSteps !== []): ?>
            <div class="infographic-flow" role="list">
                <?php foreach ($infographicSteps as $index => $step): ?>
                    <div class="infographic-step" role="listitem">
                        <div class="step-index">0<?= $index + 1; ?></div>
                        <div class="step-body">
                            <div class="step-title"><?= e($step['title']); ?></div>
                            <p class="step-desc"><?= e($step['desc']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<section class="section comparison-section" id="comparison" data-track-section="comparison">
    <div class="container">
        <h2 class="h2"><?= e($t->get('comparison.title')); ?></h2>
        <div class="comparison-grid">
            <div class="comparison-card comparison-before">
                <?php if ($beforeTitle !== ''): ?>
                    <h3><?= e($beforeTitle); ?></h3>
                <?php endif; ?>
                <?php if ($beforePoints !== []): ?>
                    <ul>
                        <?php foreach ($beforePoints as $point): ?>
                            <li><?= e($point); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="comparison-card comparison-after">
                <?php if ($afterTitle !== ''): ?>
                    <h3><?= e($afterTitle); ?></h3>
                <?php endif; ?>
                <?php if ($afterPoints !== []): ?>
                    <ul>
                        <?php foreach ($afterPoints as $point): ?>
                            <li><?= e($point); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<section class="section urgency-section" data-track-section="urgency">
    <div class="container">
        <div class="urgency-callout">
            <div>
                <h2 class="h2"><?= e($t->get('urgency.title')); ?></h2>
                <?php if ($urgencyText !== ''): ?>
                    <p class="muted"><?= e($urgencyText); ?></p>
                <?php endif; ?>
            </div>
            <a class="btn btn-primary" href="#apply" data-scroll-target="apply">
                <?= e($ctaRepeat); ?>
            </a>
        </div>
    </div>
</section>
<section class="section application-section" id="apply" data-track-section="apply">
    <div class="container application-grid">
        <div class="application-intro">
            <h2 class="h2"><?= e($form['title'] ?? $t->get('hero.primary_cta')); ?></h2>
            <p class="muted"><?= e($form['description'] ?? ''); ?></p>
            <?php if ($deadlineDate !== ''): ?>
                <p class="deadline">
                    <span class="icon-clock" aria-hidden="true"></span>
                    <span><?= e($t->get('urgency.deadline_label', ['date' => $deadlineDate], $deadlineDate)); ?></span>
                </p>
            <?php endif; ?>
        </div>
        <form
            class="pilot-form"
            id="pilotForm"
            method="post"
            action="<?= e(asset('form-submit.php')); ?>"
            data-application-form
        >
            <div class="form-grid">
                <?php if (isset($formFields['name'])): $field = $formFields['name']; ?>
                    <div class="input-control">
                        <label for="app-name"><?= e($field['label']); ?></label>
                        <input type="text" id="app-name" name="name" placeholder="<?= e($field['placeholder']); ?>" autocomplete="name" required>
                    </div>
                <?php endif; ?>
                <?php if (isset($formFields['email'])): $field = $formFields['email']; ?>
                    <div class="input-control">
                        <label for="app-email"><?= e($field['label']); ?></label>
                        <input type="email" id="app-email" name="email" placeholder="<?= e($field['placeholder']); ?>" autocomplete="email" required>
                    </div>
                <?php endif; ?>
            </div>
            <div class="form-grid">
                <?php if (isset($formFields['company'])): $field = $formFields['company']; ?>
                    <div class="input-control">
                        <label for="app-company"><?= e($field['label']); ?></label>
                        <input type="text" id="app-company" name="company" placeholder="<?= e($field['placeholder']); ?>" autocomplete="organization">
                    </div>
                <?php endif; ?>
                <?php if (isset($formFields['automation'])): $field = $formFields['automation']; ?>
                    <div class="input-control full-width">
                        <label for="app-automation"><?= e($field['label']); ?></label>
                        <textarea id="app-automation" name="automation" placeholder="<?= e($field['placeholder']); ?>" required></textarea>
                    </div>
                <?php endif; ?>
            </div>
            <label class="checkbox-field">
                <input type="checkbox" name="pilot" value="1" required>
                <span><?= e($form['checkbox_label'] ?? ''); ?></span>
            </label>
            <div class="pilot-form-actions">
                <button class="btn btn-primary" type="submit"><?= e($form['submit'] ?? $t->get('hero.primary_cta')); ?></button>
            </div>
            <p class="form-message success" data-form-success hidden><?= e($form['success'] ?? ''); ?></p>
            <p class="form-message error" data-form-error hidden><?= e($form['error'] ?? ''); ?></p>
        </form>
    </div>
</section>
<section class="section final-cta" data-track-section="final-cta">
    <div class="container">
        <div class="final-cta-card">
            <h2 class="h2"><?= e($t->get('final_cta.title', [], $t->get('hero.title'))); ?></h2>
            <p class="muted"><?= e($t->get('final_cta.lead', [], $t->get('hero.lead'))); ?></p>
            <a class="btn btn-primary" href="#apply" data-scroll-target="apply"><?= e($ctaRepeat); ?></a>
        </div>
    </div>
</section>
