<?php
/** @var App\Localization\Translator $t */
/** @var string $currentLocale */

$hero = $t->get('hero');
$pilotProgram = $t->get('pilot_program');
$infographic = $t->get('infographic');
$comparison = $t->get('comparison');
$form = $t->get('form');
$urgency = $t->get('urgency');
$finalCta = $t->get('final_cta');

$heroPoints = is_array($hero['points'] ?? null) ? $hero['points'] : [];
$pilotBenefits = is_array($pilotProgram['benefits'] ?? null) ? $pilotProgram['benefits'] : [];
$infographicSteps = is_array($infographic['steps'] ?? null) ? $infographic['steps'] : [];
$comparisonBefore = is_array($comparison['before'] ?? null) ? $comparison['before'] : [];
$comparisonAfter = is_array($comparison['after'] ?? null) ? $comparison['after'] : [];
$formFields = is_array($form['fields'] ?? null) ? $form['fields'] : [];
$deadline = (string) ($urgency['deadline'] ?? '');
$urgencyNote = (string) ($urgency['note'] ?? '');
$ctaButton = (string) ($hero['primary_cta'] ?? '');
$heroBadge = (string) ($hero['badge'] ?? '');
$heroTitle = (string) ($hero['title'] ?? 'nERP');
$heroSubtitle = (string) ($hero['subtitle'] ?? ($hero['lead'] ?? ''));
$heroSecondary = (string) ($hero['secondary_cta'] ?? '');
$formAction = (string) ($form['action'] ?? '/api/pilot.php');
$formConsent = (string) ($form['consent'] ?? '');
$formSuccess = (string) ($form['success'] ?? '');
$formError = (string) ($form['error'] ?? '');
$formCheckbox = (string) ($form['checkbox'] ?? '');
$formTitle = (string) ($form['title'] ?? '');
$formDescription = (string) ($form['description'] ?? '');
$formFieldsName = $formFields['name'] ?? [];
$formFieldsEmail = $formFields['email'] ?? [];
$formFieldsCompany = $formFields['company'] ?? [];
$formFieldsAutomation = $formFields['automation'] ?? [];
$formFieldsAutomationPlaceholder = (string) ($formFieldsAutomation['placeholder'] ?? '');
$formFieldsAutomationLabel = (string) ($formFieldsAutomation['label'] ?? '');
$formSubmit = (string) ($form['submit'] ?? $ctaButton);
$finalCtaTitle = (string) ($finalCta['title'] ?? '');
$finalCtaSubtitle = (string) ($finalCta['subtitle'] ?? '');
$finalCtaButton = (string) ($finalCta['primary'] ?? $ctaButton);
$infographicAlt = (string) ($infographic['alt'] ?? 'Как работает nERP');
?>

<section class="hero" id="top" data-track-section="hero">
    <div class="container hero-container">
        <div class="hero-content">
            <?php if ($heroBadge !== ''): ?>
                <div class="eyebrow"><?= e($heroBadge); ?></div>
            <?php endif; ?>
            <h1 class="h1"><?= e($heroTitle); ?></h1>
            <?php if ($heroSubtitle !== ''): ?>
                <p class="lead"><?= e($heroSubtitle); ?></p>
            <?php endif; ?>
            <?php if ($heroPoints !== []): ?>
                <ul class="hero-points">
                    <?php foreach ($heroPoints as $point): ?>
                        <li><?= e((string) $point); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div class="hero-actions">
                <?php if ($ctaButton !== ''): ?>
                    <a
                        class="btn btn-primary"
                        href="#apply"
                        data-scroll-target="apply"
                        data-track-event="cta_click"
                        data-track-label="hero_primary_cta"
                        data-track-location="hero"
                    >
                        <span class="icon rocket" aria-hidden="true"></span><?= e($ctaButton); ?>
                    </a>
                <?php endif; ?>
                <?php if ($heroSecondary !== ''): ?>
                    <a
                        class="btn btn-ghost"
                        href="#pilot-program"
                        data-scroll-target="pilot-program"
                        data-track-event="cta_click"
                        data-track-label="hero_secondary_cta"
                        data-track-location="hero"
                    ><?= e($heroSecondary); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section id="pilot-program" class="section" data-track-section="pilot-program">
    <div class="container section-header">
        <h2 class="h2"><?= e($pilotProgram['title'] ?? ''); ?></h2>
        <?php if (!empty($pilotProgram['description'])): ?>
            <p class="muted"><?= e((string) $pilotProgram['description']); ?></p>
        <?php endif; ?>
    </div>
    <?php if ($pilotBenefits !== []): ?>
        <div class="container benefit-grid">
            <?php foreach ($pilotBenefits as $benefit): ?>
                <article class="card benefit-card">
                    <h3 class="card-title"><?= e((string) ($benefit['title'] ?? '')); ?></h3>
                    <p class="card-desc"><?= e((string) ($benefit['description'] ?? '')); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<section id="how-it-works" class="section info-section" data-track-section="how">
    <div class="container section-header">
        <h2 class="h2"><?= e($infographic['title'] ?? ''); ?></h2>
        <?php if (!empty($infographic['subtitle'])): ?>
            <p class="muted"><?= e((string) $infographic['subtitle']); ?></p>
        <?php endif; ?>
    </div>
    <?php if ($infographicSteps !== []): ?>
        <div class="container">
            <figure class="info-flow" aria-label="<?= e($infographicAlt); ?>">
                <?php foreach ($infographicSteps as $index => $step): ?>
                    <div class="flow-step" role="group" aria-label="<?= e((string) ($step['title'] ?? '')); ?>">
                        <div class="flow-step-title"><?= e((string) ($step['title'] ?? '')); ?></div>
                        <?php if (!empty($step['description'])): ?>
                            <p class="flow-step-desc"><?= e((string) $step['description']); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if ($index < count($infographicSteps) - 1): ?>
                        <span class="flow-arrow" aria-hidden="true">→</span>
                    <?php endif; ?>
                <?php endforeach; ?>
            </figure>
        </div>
    <?php endif; ?>
</section>

<section id="comparison" class="section comparison-section" data-track-section="comparison">
    <div class="container section-header">
        <h2 class="h2"><?= e($comparison['title'] ?? ''); ?></h2>
        <?php if (!empty($comparison['subtitle'])): ?>
            <p class="muted"><?= e((string) $comparison['subtitle']); ?></p>
        <?php endif; ?>
    </div>
    <div class="container comparison-grid">
        <article class="card comparison-card">
            <div class="comparison-label negative"><?= e($comparison['before_title'] ?? ''); ?></div>
            <?php if (!empty($comparison['before_lead'])): ?>
                <p class="comparison-lead"><?= e((string) $comparison['before_lead']); ?></p>
            <?php endif; ?>
            <?php if ($comparisonBefore !== []): ?>
                <ul class="comparison-list">
                    <?php foreach ($comparisonBefore as $point): ?>
                        <li><?= e((string) $point); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </article>
        <article class="card comparison-card positive">
            <div class="comparison-label positive"><?= e($comparison['after_title'] ?? ''); ?></div>
            <?php if (!empty($comparison['after_lead'])): ?>
                <p class="comparison-lead"><?= e((string) $comparison['after_lead']); ?></p>
            <?php endif; ?>
            <?php if ($comparisonAfter !== []): ?>
                <ul class="comparison-list">
                    <?php foreach ($comparisonAfter as $point): ?>
                        <li><?= e((string) $point); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </article>
    </div>
</section>

<section id="apply" class="section apply-section" data-track-section="apply">
    <div class="container apply-grid">
        <div class="apply-copy">
            <h2 class="h2"><?= e($formTitle); ?></h2>
            <?php if ($formDescription !== ''): ?>
                <p class="muted"><?= e($formDescription); ?></p>
            <?php endif; ?>
        </div>
        <div class="card apply-card">
            <form
                id="applyForm"
                class="apply-form"
                action="<?= e($formAction); ?>"
                method="post"
                data-apply-form
                data-include-utm="true"
            >
                <input type="hidden" name="locale" value="<?= e($currentLocale ?? ''); ?>">
                <div class="input-control">
                    <label for="applyName"><?= e((string) ($formFieldsName['label'] ?? '')); ?></label>
                    <input
                        type="text"
                        id="applyName"
                        name="name"
                        placeholder="<?= e((string) ($formFieldsName['placeholder'] ?? '')); ?>"
                        autocomplete="name"
                        required
                    >
                </div>
                <div class="input-control">
                    <label for="applyEmail"><?= e((string) ($formFieldsEmail['label'] ?? '')); ?></label>
                    <input
                        type="email"
                        id="applyEmail"
                        name="email"
                        placeholder="<?= e((string) ($formFieldsEmail['placeholder'] ?? '')); ?>"
                        autocomplete="email"
                        required
                    >
                </div>
                <div class="input-control">
                    <label for="applyCompany"><?= e((string) ($formFieldsCompany['label'] ?? '')); ?></label>
                    <input
                        type="text"
                        id="applyCompany"
                        name="company"
                        placeholder="<?= e((string) ($formFieldsCompany['placeholder'] ?? '')); ?>"
                        autocomplete="organization"
                    >
                </div>
                <div class="input-control">
                    <label for="applyAutomation"><?= e($formFieldsAutomationLabel); ?></label>
                    <textarea
                        id="applyAutomation"
                        name="automation_goal"
                        rows="4"
                        placeholder="<?= e($formFieldsAutomationPlaceholder); ?>"
                        required
                    ></textarea>
                </div>
                <?php if ($formCheckbox !== ''): ?>
                    <label class="checkbox-control">
                        <input type="checkbox" name="participate" value="1" required>
                        <span><?= e($formCheckbox); ?></span>
                    </label>
                <?php endif; ?>
                <?php if ($formConsent !== ''): ?>
                    <p class="form-consent"><?= e($formConsent); ?></p>
                <?php endif; ?>
                <div class="apply-actions">
                    <button class="btn btn-primary" type="submit">
                        <span class="icon rocket" aria-hidden="true"></span><?= e($formSubmit); ?>
                    </button>
                </div>
                <?php if ($formSuccess !== ''): ?>
                    <p class="form-message success" data-form-success hidden><?= e($formSuccess); ?></p>
                <?php endif; ?>
                <?php if ($formError !== ''): ?>
                    <p class="form-message error" data-form-error hidden><?= e($formError); ?></p>
                <?php endif; ?>
            </form>
        </div>
    </div>
</section>

<?php if ($deadline !== '' || $urgencyNote !== ''): ?>
    <section id="deadline" class="section urgency-section" data-track-section="urgency">
        <div class="container">
            <div class="urgency-banner" role="alert">
                <?php if ($deadline !== ''): ?>
                    <strong><?= e($deadline); ?></strong>
                <?php endif; ?>
                <?php if ($urgencyNote !== ''): ?>
                    <span><?= e($urgencyNote); ?></span>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<section id="final-cta" class="section final-cta" data-track-section="final-cta">
    <div class="container final-cta-inner">
        <div>
            <h2 class="h2"><?= e($finalCtaTitle); ?></h2>
            <?php if ($finalCtaSubtitle !== ''): ?>
                <p class="muted"><?= e($finalCtaSubtitle); ?></p>
            <?php endif; ?>
        </div>
        <?php if ($finalCtaButton !== ''): ?>
            <a
                class="btn btn-primary"
                href="#apply"
                data-scroll-target="apply"
                data-track-event="cta_click"
                data-track-label="final_cta"
                data-track-location="footer"
            >
                <span class="icon rocket" aria-hidden="true"></span><?= e($finalCtaButton); ?>
            </a>
        <?php endif; ?>
    </div>
</section>
