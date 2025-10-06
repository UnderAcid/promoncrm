<?php
/** @var App\Localization\Translator $t */
/** @var string $currentLocale */

$heroTitle = (string) ($t->get('hero.title') ?? '');
$heroLead = (string) ($t->get('hero.lead') ?? '');
$heroCta = (string) ($t->get('hero.primary_cta') ?? '');
$heroHighlights = $t->get('landing.hero_highlights');
$heroHighlights = is_array($heroHighlights) ? array_filter(array_map('strval', $heroHighlights)) : [];

$landing = $t->get('landing');
$landing = is_array($landing) ? $landing : [];

$pilotSection = is_array($landing['pilot'] ?? null) ? $landing['pilot'] : [];
$pilotTitle = (string) ($pilotSection['title'] ?? '');
$pilotDescription = (string) ($pilotSection['description'] ?? '');
$pilotBenefits = [];
if (is_array($pilotSection['benefits'] ?? null)) {
    foreach ($pilotSection['benefits'] as $benefit) {
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

$flowSection = is_array($landing['flow'] ?? null) ? $landing['flow'] : [];
$flowTitle = (string) ($flowSection['title'] ?? '');
$flowSteps = [];
if (is_array($flowSection['steps'] ?? null)) {
    foreach ($flowSection['steps'] as $step) {
        if (!is_array($step)) {
            continue;
        }
        $label = trim((string) ($step['label'] ?? ''));
        $desc = trim((string) ($step['desc'] ?? ''));
        if ($label === '' && $desc === '') {
            continue;
        }
        $flowSteps[] = [
            'label' => $label,
            'desc' => $desc,
        ];
    }
}

$comparison = is_array($landing['comparison'] ?? null) ? $landing['comparison'] : [];
$comparisonTitle = (string) ($comparison['title'] ?? '');
$comparisonBefore = is_array($comparison['before'] ?? null) ? $comparison['before'] : [];
$comparisonAfter = is_array($comparison['after'] ?? null) ? $comparison['after'] : [];
$comparisonBeforeTitle = (string) ($comparisonBefore['title'] ?? '');
$comparisonAfterTitle = (string) ($comparisonAfter['title'] ?? '');
$comparisonBeforePoints = [];
if (is_array($comparisonBefore['points'] ?? null)) {
    foreach ($comparisonBefore['points'] as $point) {
        $text = trim((string) $point);
        if ($text !== '') {
            $comparisonBeforePoints[] = $text;
        }
    }
}
$comparisonAfterPoints = [];
if (is_array($comparisonAfter['points'] ?? null)) {
    foreach ($comparisonAfter['points'] as $point) {
        $text = trim((string) $point);
        if ($text !== '') {
            $comparisonAfterPoints[] = $text;
        }
    }
}

$deadlineSection = is_array($landing['deadline'] ?? null) ? $landing['deadline'] : [];
$deadlineText = (string) ($deadlineSection['text'] ?? '');
$deadlineCaption = (string) ($deadlineSection['caption'] ?? '');

$formConfig = is_array($landing['form'] ?? null) ? $landing['form'] : [];
$formTitle = (string) ($formConfig['title'] ?? '');
$formSubtitle = (string) ($formConfig['subtitle'] ?? '');
$formAction = (string) ($formConfig['action'] ?? '/pilot-request.php');
$formFields = is_array($formConfig['fields'] ?? null) ? $formConfig['fields'] : [];
$formConsent = (string) ($formConfig['consent'] ?? '');
$formSubmit = (string) ($formConfig['submit'] ?? $heroCta);
$formSuccess = (string) ($formConfig['success'] ?? '');
$formError = (string) ($formConfig['error'] ?? '');

$finalCta = is_array($landing['final_cta'] ?? null) ? $landing['final_cta'] : [];
$finalTitle = (string) ($finalCta['title'] ?? '');
$finalDescription = (string) ($finalCta['description'] ?? '');
$finalButton = (string) ($finalCta['cta'] ?? $heroCta);
?>
<section id="hero" class="section hero-section">
    <div class="container">
        <div class="grid two hero-grid">
            <div class="hero-copy">
                <?php if ($heroHighlights !== []): ?>
                    <div class="tags hero-tags">
                        <?php foreach ($heroHighlights as $tag): ?>
                            <span class="tag"><?= e($tag); ?></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <h1 class="h1 hero-title"><?= e($heroTitle); ?></h1>
                <?php if ($heroLead !== ''): ?>
                    <p class="lead hero-lead"><?= e($heroLead); ?></p>
                <?php endif; ?>
                <?php if ($heroCta !== ''): ?>
                    <div class="hero-cta">
                        <a class="btn btn-primary btn-large" href="#apply" data-scroll-to-apply>
                            <?= e($heroCta); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="hero-visual" aria-hidden="true">
                <div class="hero-visual-orb">
                    <div class="hero-visual-node hero-visual-node--data">Data</div>
                    <div class="hero-visual-node hero-visual-node--shield">Encrypt</div>
                    <div class="hero-visual-node hero-visual-node--chain">Node</div>
                    <div class="hero-visual-node hero-visual-node--spark">Result</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="pilot-program" class="section pilot-section">
    <div class="container">
        <?php if ($pilotTitle !== ''): ?>
            <h2 class="h2"><?= e($pilotTitle); ?></h2>
        <?php endif; ?>
        <?php if ($pilotDescription !== ''): ?>
            <p class="lead"><?= e($pilotDescription); ?></p>
        <?php endif; ?>
        <?php if ($pilotBenefits !== []): ?>
            <div class="pilot-benefits">
                <?php foreach ($pilotBenefits as $benefit): ?>
                    <article class="card pilot-benefit">
                        <h3 class="card-title"><?= e($benefit['title']); ?></h3>
                        <?php if ($benefit['desc'] !== ''): ?>
                            <p class="card-desc"><?= e($benefit['desc']); ?></p>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<section id="how-it-works" class="section flow-section">
    <div class="container">
        <?php if ($flowTitle !== ''): ?>
            <h2 class="h2"><?= e($flowTitle); ?></h2>
        <?php endif; ?>
        <?php if ($flowSteps !== []): ?>
            <div class="flow-diagram" role="list">
                <?php foreach ($flowSteps as $index => $step): ?>
                    <div class="flow-step" role="listitem">
                        <div class="flow-step-index">0<?= $index + 1; ?></div>
                        <div class="flow-step-title"><?= e($step['label']); ?></div>
                        <?php if ($step['desc'] !== ''): ?>
                            <p class="flow-step-desc"><?= e($step['desc']); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<section id="compare" class="section compare-section">
    <div class="container">
        <?php if ($comparisonTitle !== ''): ?>
            <h2 class="h2"><?= e($comparisonTitle); ?></h2>
        <?php endif; ?>
        <div class="comparison-grid">
            <article class="card comparison-card comparison-card--before">
                <?php if ($comparisonBeforeTitle !== ''): ?>
                    <h3 class="comparison-card-title"><?= e($comparisonBeforeTitle); ?></h3>
                <?php endif; ?>
                <?php if ($comparisonBeforePoints !== []): ?>
                    <ul class="comparison-list">
                        <?php foreach ($comparisonBeforePoints as $point): ?>
                            <li><?= e($point); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </article>
            <article class="card comparison-card comparison-card--after">
                <?php if ($comparisonAfterTitle !== ''): ?>
                    <h3 class="comparison-card-title"><?= e($comparisonAfterTitle); ?></h3>
                <?php endif; ?>
                <?php if ($comparisonAfterPoints !== []): ?>
                    <ul class="comparison-list">
                        <?php foreach ($comparisonAfterPoints as $point): ?>
                            <li><?= e($point); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </article>
        </div>
    </div>
</section>

<?php if ($deadlineText !== '' || $deadlineCaption !== ''): ?>
    <section class="section deadline-section">
        <div class="container">
            <div class="deadline-banner">
                <?php if ($deadlineText !== ''): ?>
                    <p class="deadline-text"><?= e($deadlineText); ?></p>
                <?php endif; ?>
                <?php if ($deadlineCaption !== ''): ?>
                    <p class="deadline-caption"><?= e($deadlineCaption); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<section id="apply" class="section apply-section">
    <div class="container">
        <div class="apply-grid">
            <div class="apply-intro">
                <?php if ($formTitle !== ''): ?>
                    <h2 class="h2"><?= e($formTitle); ?></h2>
                <?php endif; ?>
                <?php if ($formSubtitle !== ''): ?>
                    <p class="lead"><?= e($formSubtitle); ?></p>
                <?php endif; ?>
            </div>
            <form
                id="pilotForm"
                class="card apply-form"
                method="post"
                action="<?= e($formAction); ?>"
                data-pilot-form
            >
                <div class="form-grid">
                    <?php foreach ($formFields as $field): ?>
                        <?php
                        if (!is_array($field)) {
                            continue;
                        }
                        $name = trim((string) ($field['name'] ?? ''));
                        $label = trim((string) ($field['label'] ?? ''));
                        $placeholder = trim((string) ($field['placeholder'] ?? ''));
                        $type = trim((string) ($field['type'] ?? 'text'));
                        $required = (bool) ($field['required'] ?? false);
                        $isTextarea = ($field['component'] ?? '') === 'textarea';
                        if ($name === '') {
                            continue;
                        }
                        $fieldId = 'field_' . preg_replace('/[^a-z0-9_\-]+/i', '_', strtolower($name));
                        ?>
                        <div class="form-field">
                            <?php if ($label !== ''): ?>
                                <label for="<?= e($fieldId); ?>"><?= e($label); ?></label>
                            <?php endif; ?>
                            <?php if ($isTextarea): ?>
                                <textarea
                                    id="<?= e($fieldId); ?>"
                                    name="<?= e($name); ?>"
                                    rows="4"
                                    placeholder="<?= e($placeholder); ?>"
                                    <?= $required ? 'required' : ''; ?>
                                ></textarea>
                            <?php else: ?>
                                <input
                                    id="<?= e($fieldId); ?>"
                                    type="<?= e($type); ?>"
                                    name="<?= e($name); ?>"
                                    placeholder="<?= e($placeholder); ?>"
                                    <?= $required ? 'required' : ''; ?>
                                >
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="form-checkbox">
                    <label>
                        <input type="checkbox" name="participation" value="1" required>
                        <span><?= e($t->get('landing.form.checkbox') ?? ''); ?></span>
                    </label>
                </div>
                <?php if ($formConsent !== ''): ?>
                    <p class="form-consent"><?= e($formConsent); ?></p>
                <?php endif; ?>
                <button type="submit" class="btn btn-primary btn-large">
                    <?= e($formSubmit); ?>
                </button>
                <?php if ($formSuccess !== ''): ?>
                    <p class="form-message success" data-pilot-success hidden><?= e($formSuccess); ?></p>
                <?php endif; ?>
                <?php if ($formError !== ''): ?>
                    <p class="form-message error" data-pilot-error hidden><?= e($formError); ?></p>
                <?php endif; ?>
            </form>
        </div>
    </div>
</section>

<?php if ($finalTitle !== '' || $finalDescription !== '' || $finalButton !== ''): ?>
    <section class="section final-cta-section">
        <div class="container">
            <div class="card final-cta-card">
                <?php if ($finalTitle !== ''): ?>
                    <h2 class="final-cta-title"><?= e($finalTitle); ?></h2>
                <?php endif; ?>
                <?php if ($finalDescription !== ''): ?>
                    <p class="final-cta-desc"><?= e($finalDescription); ?></p>
                <?php endif; ?>
                <?php if ($finalButton !== ''): ?>
                    <a class="btn btn-primary btn-large" href="#apply">
                        <?= e($finalButton); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
