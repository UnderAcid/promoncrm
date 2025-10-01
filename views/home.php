<?php
/** @var App\Localization\Translator $t */
/** @var array<string, mixed>|null $pilotStatus */
/** @var array<string, string> $pilotFormData */

$heroTags = $t->get('hero.tags');
$heroCards = $t->get('hero.feature_cards');
$audienceOptions = $t->get('audience.options');
$defaultAudience = array_key_first($audienceOptions) ?? 'business';
$audiencePitch = $t->get('audience.pitches.' . $defaultAudience);
$whyBlocks = $t->get('why.blocks');
$howItems = $t->get('how.items');
$partnerCards = $t->get('partners.cards');
$pilotPoints = $t->get('pilots.points');
$logos = $t->get('logos.brands');
$faqItems = $t->get('faq.items');

$pilotPoints = is_array($pilotPoints) ? $pilotPoints : [];
$pilotFormData = [
    'name' => $pilotFormData['name'] ?? '',
    'email' => $pilotFormData['email'] ?? '',
    'company' => $pilotFormData['company'] ?? '',
    'message' => $pilotFormData['message'] ?? '',
];

$pilotErrorFields = [];
$pilotStatusValue = is_array($pilotStatus) ? ($pilotStatus['status'] ?? null) : null;
if (is_array($pilotStatus) && ($pilotStatus['status'] ?? null) === 'error' && isset($pilotStatus['fields']) && is_array($pilotStatus['fields'])) {
    $pilotErrorFields = $pilotStatus['fields'];
}
$isPilotSuccess = $pilotStatusValue === 'success';
?>
<section class="container section-hero" id="hero">
    <div class="grid two">
        <div>
            <div class="tags">
                <?php foreach ($heroTags as $tag): ?>
                    <span class="tag"><?= e($tag); ?></span>
                <?php endforeach; ?>
            </div>
            <h1 class="h1"><?= e($t->get('hero.title')); ?></h1>
            <p class="lead"><?= e($t->get('hero.lead')); ?></p>
            <div class="cta-row">
                <a class="btn btn-primary" href="#pilots">
                    <span class="icon rocket" aria-hidden="true"></span><?= e($t->get('hero.primary_cta')); ?>
                </a>
                <a class="btn btn-ghost" href="#how">
                    <span class="icon play" aria-hidden="true"></span><?= e($t->get('hero.secondary_cta')); ?>
                </a>
            </div>

            <div class="grid three feature-cards">
                <?php foreach ($heroCards as $card): ?>
                    <div class="card">
                        <div class="card-row">
                            <div class="icon-bubble"><span class="icon <?= e($card['icon']); ?>" aria-hidden="true"></span></div>
                            <div>
                                <div class="card-title"><?= e($card['title']); ?></div>
                                <div class="card-desc"><?= e($card['desc']); ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="illustration" aria-hidden="true">
            <div class="illus">
                <div class="illus-grid">
                    <div></div><div></div><div></div>
                    <div></div><div></div><div></div>
                    <div></div><div></div><div></div>
                </div>
                <div class="illus-bottom">
                    <div class="illus-bar"></div>
                    <div class="illus-chip"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="divider" role="presentation"></div>

<section id="for" class="container audience-section">
    <h2 class="h2"><?= e($t->get('audience.title')); ?></h2>
    <p class="muted"><?= e($t->get('audience.subtitle')); ?></p>
    <div class="grid three audience">
        <?php foreach ($audienceOptions as $key => $option): ?>
            <button class="aud-card<?= $key === $defaultAudience ? ' selected' : ''; ?>" data-audience="<?= e($key); ?>" type="button">
                <div class="card-row">
                    <div class="aud-icon"><span class="icon <?= e($option['icon']); ?>" aria-hidden="true"></span></div>
                    <div>
                        <div class="card-title"><?= e($option['title']); ?></div>
                        <div class="card-desc"><?= e($option['desc']); ?></div>
                    </div>
                </div>
            </button>
        <?php endforeach; ?>
    </div>
    <div class="audience-pitch card" id="audiencePitch" data-audience-pitch>
        <div class="card-row">
            <div class="icon-bubble"><span class="icon <?= e($audiencePitch['icon']); ?>" aria-hidden="true"></span></div>
            <div>
                <div class="card-title"><?= e($audiencePitch['title']); ?></div>
                <p class="card-desc"><?= e($audiencePitch['desc']); ?></p>
            </div>
        </div>
    </div>
    <div class="cta-row">
        <a class="btn btn-primary" href="#pilots"><span class="icon sparkles" aria-hidden="true"></span><?= e($t->get('audience.cta')); ?></a>
    </div>
</section>

<div class="divider" role="presentation"></div>

<section id="why" class="container why-section">
    <h2 class="h2"><?= e($t->get('why.title')); ?></h2>
    <div class="grid three feature-cards">
        <?php foreach ($whyBlocks as $block): ?>
            <div class="card">
                <div class="card-row">
                    <div class="icon-bubble"><span class="icon <?= e($block['icon']); ?>" aria-hidden="true"></span></div>
                    <div>
                        <div class="card-title"><?= e($block['title']); ?></div>
                        <div class="card-desc"><?= e($block['desc']); ?></div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<div class="divider" role="presentation"></div>

<section id="how" class="container how-section">
    <h2 class="h2"><?= e($t->get('how.title')); ?></h2>
    <div class="grid three">
        <?php foreach ($howItems as $item): ?>
            <div class="card">
                <div class="card-title"><?= e($item['title']); ?></div>
                <p class="card-desc"><?= e($item['desc']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<div class="divider" role="presentation"></div>

<section id="pricing" class="container pricing-section">
    <h2 class="h2"><?= e($t->get('pricing.title')); ?></h2>
    <p class="muted"><?= e($t->get('pricing.subtitle')); ?></p>
    <div class="grid two">
        <div class="card calculator">
            <label for="people" class="calc-label">
                <?= e($t->get('pricing.team_size')); ?>: <span id="peopleVal">50</span>
            </label>
            <input type="range" id="people" name="people" min="5" max="200" step="5" value="50">

            <label for="apd" class="calc-label">
                <?= e($t->get('pricing.actions_per_day')); ?>: <span id="apdVal">20</span>
            </label>
            <input type="range" id="apd" name="apd" min="5" max="200" step="5" value="20">

            <p class="muted small"><?= e($t->get('pricing.hint')); ?></p>
        </div>
        <div class="card calc-output">
            <div class="calc-row">
                <span><?= e($t->get('pricing.monthly_actions')); ?></span>
                <strong id="opsMonthly">0</strong>
            </div>
            <div class="calc-row">
                <span><?= e($t->get('pricing.nerp_total')); ?></span>
                <strong id="nerpTotal">0</strong>
            </div>
            <div class="calc-row">
                <span><?= e($t->get('pricing.usd_equivalent')); ?></span>
                <strong id="usdApprox">$0</strong>
            </div>
            <p class="muted small"><?= e($t->get('pricing.micro_fee')); ?></p>
            <a class="btn btn-primary" href="#pilots">
                <span class="icon chat" aria-hidden="true"></span><?= e($t->get('pricing.primary_cta')); ?>
            </a>
        </div>
    </div>
</section>

<div class="divider" role="presentation"></div>

<section id="partners" class="container">
    <h2 class="h2"><?= e($t->get('partners.title')); ?></h2>
    <div class="grid three">
        <?php foreach ($partnerCards as $card): ?>
            <div class="card">
                <div class="card-row">
                    <div class="icon-bubble"><span class="icon <?= e($card['icon']); ?>" aria-hidden="true"></span></div>
                    <div>
                        <div class="card-title"><?= e($card['title']); ?></div>
                        <div class="card-desc"><?= e($card['desc']); ?></div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<div class="divider" role="presentation"></div>

<section class="container logos-section">
    <div class="grid two-66">
        <div>
            <div class="eyebrow"><?= e($t->get('logos.eyebrow')); ?></div>
            <div class="logo-grid">
                <?php foreach ($logos as $brand): ?>
                    <div><?= e($brand); ?></div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="card">
            <div class="card-desc"><?= e($t->get('logos.quote')); ?></div>
            <div class="card-title mt-8"><?= e($t->get('logos.quote_author')); ?></div>
        </div>
    </div>
</section>

<div class="divider" role="presentation"></div>

<section id="pilots" class="container pilots-section">
    <div class="grid two-66">
        <div>
            <h2 class="h2"><?= e($t->get('pilots.title')); ?></h2>
            <p class="muted"><?= e($t->get('pilots.subtitle')); ?></p>
            <div class="grid three pilot-points">
                <?php foreach ($pilotPoints as $point): ?>
                    <div class="card">
                        <div class="card-row">
                            <div class="icon-bubble"><span class="icon <?= e($point['icon']); ?>" aria-hidden="true"></span></div>
                            <div>
                                <div class="card-title"><?= e($point['title']); ?></div>
                                <p class="card-desc"><?= e($point['desc']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="card pilot-card">
            <h3 class="card-title"><?= e($t->get('pilots.form.title')); ?></h3>
            <?php if ($isPilotSuccess): ?>
                <div class="form-message success">
                    <span class="icon check" aria-hidden="true"></span><?= e($t->get('pilots.form.success')); ?>
                </div>
            <?php elseif ($pilotStatusValue === 'error'): ?>
                <div class="form-message error">
                    <span class="icon alert" aria-hidden="true"></span><?= e($t->get('pilots.form.error')); ?>
                </div>
            <?php endif; ?>
            <form method="post" class="pilot-form" novalidate>
                <input type="hidden" name="pilot_form" value="1">
                <div class="form-field<?= in_array('name', $pilotErrorFields, true) ? ' has-error' : ''; ?>">
                    <label for="pilotName"><?= e($t->get('pilots.form.name')); ?></label>
                    <input type="text" id="pilotName" name="pilot_name" value="<?= e($pilotFormData['name']); ?>" autocomplete="name" required>
                    <?php if (in_array('name', $pilotErrorFields, true)): ?>
                        <p class="form-error"><?= e($t->get('pilots.form.errors.name')); ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-field<?= in_array('email', $pilotErrorFields, true) ? ' has-error' : ''; ?>">
                    <label for="pilotEmail"><?= e($t->get('pilots.form.email')); ?></label>
                    <input type="email" id="pilotEmail" name="pilot_email" value="<?= e($pilotFormData['email']); ?>" autocomplete="email" required>
                    <?php if (in_array('email', $pilotErrorFields, true)): ?>
                        <p class="form-error"><?= e($t->get('pilots.form.errors.email')); ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-field<?= in_array('company', $pilotErrorFields, true) ? ' has-error' : ''; ?>">
                    <label for="pilotCompany"><?= e($t->get('pilots.form.company')); ?></label>
                    <input type="text" id="pilotCompany" name="pilot_company" value="<?= e($pilotFormData['company']); ?>" autocomplete="organization" required>
                    <?php if (in_array('company', $pilotErrorFields, true)): ?>
                        <p class="form-error"><?= e($t->get('pilots.form.errors.company')); ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-field<?= in_array('message', $pilotErrorFields, true) ? ' has-error' : ''; ?>">
                    <label for="pilotMessage"><?= e($t->get('pilots.form.message')); ?></label>
                    <textarea id="pilotMessage" name="pilot_message" rows="4" required><?= e($pilotFormData['message']); ?></textarea>
                    <?php if (in_array('message', $pilotErrorFields, true)): ?>
                        <p class="form-error"><?= e($t->get('pilots.form.errors.message')); ?></p>
                    <?php endif; ?>
                </div>
                <button class="btn btn-primary" type="submit">
                    <span class="icon rocket" aria-hidden="true"></span><?= e($t->get('pilots.form.submit')); ?>
                </button>
            </form>
        </div>
    </div>
</section>

<div class="divider" role="presentation"></div>

<section class="container center">
    <h2 class="h2"><?= e($t->get('cta.title')); ?></h2>
    <p class="muted"><?= e($t->get('cta.subtitle')); ?></p>
    <div class="cta-row">
        <a class="btn btn-primary" href="#pilots"><span class="icon rocket" aria-hidden="true"></span><?= e($t->get('cta.primary_cta')); ?></a>
        <a class="btn btn-ghost" href="#how"><span class="icon play" aria-hidden="true"></span><?= e($t->get('cta.secondary_cta')); ?></a>
    </div>
</section>

<div class="divider" role="presentation"></div>

<section id="faq" class="container pb-xxl">
    <h2 class="h2"><?= e($t->get('faq.title')); ?></h2>
    <div class="faq">
        <?php foreach ($faqItems as $item): ?>
            <div class="card faq-item">
                <button class="faq-q" type="button">
                    <span><?= e($item['question']); ?></span>
                    <span class="icon chevron" aria-hidden="true"></span>
                </button>
                <p class="faq-a"><?= e($item['answer']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>
