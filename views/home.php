<?php
/** @var App\Localization\Translator $t */
/** @var string $currentLocale */

$heroTitle = (string) ($t->get('hero.title') ?? '');
$heroLead = (string) ($t->get('hero.lead') ?? '');
$heroCta = (string) ($t->get('hero.primary_cta') ?? '');
$heroTags = $t->get('hero.tags');
if (!is_array($heroTags)) {
    $heroTags = [];
}

$landing = $t->get('landing');
if (!is_array($landing)) {
    $landing = [];
}

$pilotProgram = is_array($landing['pilot_program'] ?? null) ? $landing['pilot_program'] : [];
$pilotTitle = (string) ($pilotProgram['title'] ?? '');
$pilotText = (string) ($pilotProgram['text'] ?? '');
$pilotBenefits = [];
if (is_array($pilotProgram['benefits'] ?? null)) {
    foreach ($pilotProgram['benefits'] as $benefit) {
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

$infographic = is_array($landing['infographic'] ?? null) ? $landing['infographic'] : [];
$infographicTitle = (string) ($infographic['title'] ?? '');
$infographicSteps = [];
if (is_array($infographic['steps'] ?? null)) {
    foreach ($infographic['steps'] as $step) {
        if (!is_array($step)) {
            continue;
        }
        $stepTitle = trim((string) ($step['title'] ?? ''));
        $stepDesc = trim((string) ($step['desc'] ?? ''));
        if ($stepTitle === '' && $stepDesc === '') {
            continue;
        }
        $infographicSteps[] = [
            'title' => $stepTitle,
            'desc' => $stepDesc,
        ];
    }
}

$comparison = is_array($landing['comparison'] ?? null) ? $landing['comparison'] : [];
$comparisonTitle = (string) ($comparison['title'] ?? '');
$comparisonBeforeTitle = (string) ($comparison['before_title'] ?? '');
$comparisonAfterTitle = (string) ($comparison['after_title'] ?? '');
$comparisonBeforePoints = [];
if (is_array($comparison['before_points'] ?? null)) {
    foreach ($comparison['before_points'] as $point) {
        $text = trim((string) $point);
        if ($text !== '') {
            $comparisonBeforePoints[] = $text;
        }
    }
}
$comparisonAfterPoints = [];
if (is_array($comparison['after_points'] ?? null)) {
    foreach ($comparison['after_points'] as $point) {
        $text = trim((string) $point);
        if ($text !== '') {
            $comparisonAfterPoints[] = $text;
        }
    }
}

$formConfig = is_array($landing['form'] ?? null) ? $landing['form'] : [];
$formTitle = (string) ($formConfig['title'] ?? '');
$formSubtitle = (string) ($formConfig['subtitle'] ?? '');
$formAction = (string) ($formConfig['action'] ?? '');
$formFields = [];
if (is_array($formConfig['fields'] ?? null)) {
    foreach ($formConfig['fields'] as $key => $field) {
        if (!is_array($field)) {
            continue;
        }
        $label = trim((string) ($field['label'] ?? ''));
        if ($label === '') {
            continue;
        }
        $formFields[$key] = [
            'label' => $label,
            'placeholder' => (string) ($field['placeholder'] ?? ''),
            'required' => (bool) ($field['required'] ?? false),
        ];
    }
}
$formCheckbox = (string) ($formConfig['checkbox'] ?? '');
$formSubmit = (string) ($formConfig['submit'] ?? '');
$formSuccess = (string) ($formConfig['success'] ?? '');
$formError = (string) ($formConfig['error'] ?? '');

$urgency = is_array($landing['urgency'] ?? null) ? $landing['urgency'] : [];
$urgencyDeadline = (string) ($urgency['deadline'] ?? '');
$urgencyText = (string) ($urgency['text'] ?? '');

$ctaRepeat = is_array($landing['cta_repeat'] ?? null) ? $landing['cta_repeat'] : [];
$ctaRepeatTitle = (string) ($ctaRepeat['title'] ?? '');
$ctaRepeatSubtitle = (string) ($ctaRepeat['subtitle'] ?? '');
$ctaRepeatButton = (string) ($ctaRepeat['button'] ?? '');
?>
<section id="hero" class="container section-hero hero-section" data-track-section="hero">
    <div class="hero-grid">
        <div class="hero-content">
            <?php if ($heroTags !== []): ?>
                <div class="tags">
                    <?php foreach ($heroTags as $tag): ?>
                        <span class="tag"><?= e((string) $tag); ?></span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if ($heroTitle !== ''): ?>
                <h1 class="h1"><?= e($heroTitle); ?></h1>
            <?php endif; ?>
            <?php if ($heroLead !== ''): ?>
                <p class="lead"><?= e($heroLead); ?></p>
            <?php endif; ?>
            <?php if ($heroCta !== ''): ?>
                <div class="cta-row">
                    <a
                        class="btn btn-primary"
                        href="#apply"
                        data-scroll-to-pilots
                        data-track-event="cta_click"
                        data-track-label="hero_primary"
                        data-track-location="hero"
                        data-append-utm="true"
                    >
                        <span class="icon rocket" aria-hidden="true"></span><?= e($heroCta); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <?php if ($pilotTitle !== '' || $pilotText !== '' || $pilotBenefits !== []): ?>
            <div class="hero-side card">
                <?php if ($pilotTitle !== ''): ?>
                    <div class="card-title"><?= e($pilotTitle); ?></div>
                <?php endif; ?>
                <?php if ($pilotText !== ''): ?>
                    <p class="card-desc"><?= e($pilotText); ?></p>
                <?php endif; ?>
                <?php if ($pilotBenefits !== []): ?>
                    <ul class="hero-benefits">
                        <?php foreach ($pilotBenefits as $benefit): ?>
                            <li><?= e($benefit['title']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<div class="divider" role="presentation"></div>

<section id="pilot" class="container pilot-section" data-track-section="pilot">
    <?php if ($pilotTitle !== ''): ?>
        <h2 class="h2"><?= e($pilotTitle); ?></h2>
    <?php endif; ?>
    <?php if ($pilotText !== ''): ?>
        <p class="muted pilot-lead"><?= e($pilotText); ?></p>
    <?php endif; ?>
    <?php if ($pilotBenefits !== []): ?>
        <div class="grid three pilot-benefits">
            <?php foreach ($pilotBenefits as $benefit): ?>
                <div class="card benefit-card">
                    <div class="card-title"><?= e($benefit['title']); ?></div>
                    <?php if ($benefit['desc'] !== ''): ?>
                        <p class="card-desc"><?= e($benefit['desc']); ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<div class="divider" role="presentation"></div>

<section id="how" class="container visual-section" data-track-section="how_it_works">
    <?php if ($infographicTitle !== ''): ?>
        <h2 class="h2"><?= e($infographicTitle); ?></h2>
    <?php endif; ?>
    <?php if ($infographicSteps !== []): ?>
        <ol class="infographic-flow" aria-label="<?= e($infographicTitle); ?>">
            <?php foreach ($infographicSteps as $index => $step): ?>
                <li>
                    <div class="flow-index">0<?= e((string) ($index + 1)); ?></div>
                    <div class="flow-title"><?= e($step['title']); ?></div>
                    <?php if ($step['desc'] !== ''): ?>
                        <p class="flow-desc"><?= e($step['desc']); ?></p>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ol>
    <?php endif; ?>
    <?php if ($comparisonTitle !== ''): ?>
        <h3 class="h3 comparison-heading"><?= e($comparisonTitle); ?></h3>
    <?php endif; ?>
    <div class="comparison-grid" role="presentation">
        <div class="card comparison-card">
            <?php if ($comparisonBeforeTitle !== ''): ?>
                <div class="comparison-title"><?= e($comparisonBeforeTitle); ?></div>
            <?php endif; ?>
            <?php if ($comparisonBeforePoints !== []): ?>
                <ul>
                    <?php foreach ($comparisonBeforePoints as $point): ?>
                        <li><?= e($point); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
        <div class="card comparison-card positive">
            <?php if ($comparisonAfterTitle !== ''): ?>
                <div class="comparison-title"><?= e($comparisonAfterTitle); ?></div>
            <?php endif; ?>
            <?php if ($comparisonAfterPoints !== []): ?>
                <ul>
                    <?php foreach ($comparisonAfterPoints as $point): ?>
                        <li><?= e($point); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</section>

<div class="divider" role="presentation"></div>

<section id="apply" class="container apply-section" data-track-section="apply">
    <div class="apply-grid">
        <div class="apply-copy">
            <?php if ($formTitle !== ''): ?>
                <h2 class="h2"><?= e($formTitle); ?></h2>
            <?php endif; ?>
            <?php if ($formSubtitle !== ''): ?>
                <p class="lead"><?= e($formSubtitle); ?></p>
            <?php endif; ?>
            <?php if ($urgencyText !== ''): ?>
                <div class="urgency-banner">
                    <?php if ($urgencyDeadline !== ''): ?>
                        <div class="urgency-deadline"><?= e($urgencyDeadline); ?></div>
                    <?php endif; ?>
                    <p><?= e($urgencyText); ?></p>
                </div>
            <?php endif; ?>
        </div>
        <div>
            <form
                id="pilotForm"
                class="card pilot-form"
                action="<?= e($formAction !== '' ? $formAction : '#'); ?>"
                method="post"
                data-pilot-form
                data-track-form="pilot"
                data-include-utm="true"
            >
                <input type="hidden" name="locale" value="<?= e($currentLocale ?? 'ru'); ?>">
                <div class="form-grid">
                    <?php foreach ($formFields as $key => $field): ?>
                        <?php
                        $inputId = 'pilot' . ucfirst($key);
                        $isTextArea = $key === 'needs';
                        $placeholder = $field['placeholder'];
                        $required = $field['required'];
                        $autocomplete = '';
                        switch ($key) {
                            case 'name':
                                $autocomplete = 'name';
                                break;
                            case 'email':
                                $autocomplete = 'email';
                                break;
                            case 'company':
                                $autocomplete = 'organization';
                                break;
                            default:
                                $autocomplete = 'off';
                                break;
                        }
                        ?>
                        <div class="input-control">
                            <label for="<?= e($inputId); ?>"><?= e($field['label']); ?><?php if ($required): ?><span aria-hidden="true">*</span><?php endif; ?></label>
                            <?php if ($isTextArea): ?>
                                <textarea
                                    id="<?= e($inputId); ?>"
                                    name="<?= e($key); ?>"
                                    placeholder="<?= e($placeholder); ?>"
                                    <?= $required ? 'required' : ''; ?>
                                ></textarea>
                            <?php else: ?>
                                <input
                                    type="<?= $key === 'email' ? 'email' : 'text'; ?>"
                                    id="<?= e($inputId); ?>"
                                    name="<?= e($key); ?>"
                                    placeholder="<?= e($placeholder); ?>"
                                    autocomplete="<?= e($autocomplete); ?>"
                                    <?= $required ? 'required' : ''; ?>
                                >
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php if ($formCheckbox !== ''): ?>
                    <label class="checkbox-control">
                        <input type="checkbox" name="consent" value="1" required>
                        <span><?= e($formCheckbox); ?></span>
                    </label>
                <?php endif; ?>
                <div class="pilot-form-actions">
                    <button
                        class="btn btn-primary"
                        type="submit"
                        data-track-event="cta_click"
                        data-track-label="form_submit"
                        data-track-location="form"
                    >
                        <span class="icon send" aria-hidden="true"></span><?= e($formSubmit !== '' ? $formSubmit : $heroCta); ?>
                    </button>
                </div>
                <?php if ($formSuccess !== ''): ?>
                    <p class="form-feedback success" data-pilot-success hidden><?= e($formSuccess); ?></p>
                <?php endif; ?>
                <?php if ($formError !== ''): ?>
                    <p class="form-feedback error" data-pilot-error hidden><?= e($formError); ?></p>
                <?php endif; ?>
            </form>
        </div>
    </div>
</section>

<div class="divider" role="presentation"></div>

<?php if ($ctaRepeatTitle !== '' || $ctaRepeatSubtitle !== '' || $ctaRepeatButton !== ''): ?>
    <section class="container cta-repeat-section" data-track-section="cta_repeat">
        <div class="card cta-repeat-card">
            <?php if ($ctaRepeatTitle !== ''): ?>
                <h2 class="h2"><?= e($ctaRepeatTitle); ?></h2>
            <?php endif; ?>
            <?php if ($ctaRepeatSubtitle !== ''): ?>
                <p class="muted"><?= e($ctaRepeatSubtitle); ?></p>
            <?php endif; ?>
            <?php if ($ctaRepeatButton !== ''): ?>
                <div class="cta-row">
                    <a
                        class="btn btn-primary"
                        href="#apply"
                        data-scroll-to-pilots
                        data-track-event="cta_click"
                        data-track-label="cta_repeat"
                        data-track-location="footer_cta"
                        data-append-utm="true"
                    >
                        <span class="icon rocket" aria-hidden="true"></span><?= e($ctaRepeatButton); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

