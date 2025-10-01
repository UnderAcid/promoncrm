<?php
/** @var App\Localization\Translator $t */
/** @var string $currentLocale */

$heroTags = $t->get('hero.tags');
$heroCards = $t->get('hero.feature_cards');
$audienceOptions = $t->get('audience.options');
$defaultAudience = array_key_first($audienceOptions) ?? 'business';
$audiencePitch = $t->get('audience.pitches.' . $defaultAudience);
$whyBlocks = $t->get('why.blocks');
$howItems = $t->get('how.items');
$stack = $t->get('stack');
$stackHighlights = is_array($stack['highlights'] ?? null) ? $stack['highlights'] : [];
$stackIntegrations = is_array($stack['integrations'] ?? null) ? $stack['integrations'] : [];
$tokenPricePresets = [0.1, 0.5, 1.0, 2.0];
$tokenPresetCurrency = (string) ($t->get('pricing.token_price_presets_currency') ?? '$');
$partnerCards = $t->get('partners.cards');
$logosConfig = $t->get('logos');
$faqItems = $t->get('faq.items');
$pilotStoriesRaw = is_array($logosConfig['pilots'] ?? null) ? $logosConfig['pilots'] : [];
$pilotStories = [];
foreach ($pilotStoriesRaw as $index => $story) {
    if (!is_array($story)) {
        continue;
    }
    $storyId = (string) ($story['id'] ?? '');
    if ($storyId === '') {
        $source = (string) ($story['company'] ?? $story['label'] ?? ('pilot-' . $index));
        $storyId = strtolower(preg_replace('/[^a-z0-9]+/', '-', $source));
        if ($storyId === '') {
            $storyId = 'pilot-' . $index;
        }
    }
    $pilotStories[] = [
        'id' => $storyId,
        'label' => (string) ($story['label'] ?? $story['company'] ?? $storyId),
        'company' => (string) ($story['company'] ?? ''),
        'quote' => (string) ($story['quote'] ?? ''),
        'role' => (string) ($story['role'] ?? ''),
        'metric' => (string) ($story['metric'] ?? ''),
    ];
}
$defaultPilotId = (string) ($logosConfig['default'] ?? '');
if ($defaultPilotId === '' && $pilotStories !== []) {
    $defaultPilotId = $pilotStories[0]['id'];
}
$pilotPoints = $t->get('pilots.points');
$pilotForm = $t->get('pilots.form');
$pricingOperations = $t->get('pricing.operations');
$pricingOperations = is_array($pricingOperations) ? $pricingOperations : [];
$tokenDecimals = (int) ($t->get('pricing.token_decimals') ?? 6);
$tokenPriceUsdDefault = (float) ($t->get('pricing.token_price_usd') ?? 1.0);
$tokenPriceMinUsd = max((float) ($t->get('pricing.token_price_min_usd') ?? 1.0), 0.01);
$tokenPriceStepUsd = max((float) ($t->get('pricing.token_price_step_usd') ?? 1.0), 0.01);
$tokenPriceDecimals = (int) ($t->get('pricing.token_price_decimals') ?? 2);
$fiatPerUsd = (float) ($t->get('pricing.fiat_per_usd') ?? 1.0);
$tokenPriceDefaultLocal = $tokenPriceUsdDefault * $fiatPerUsd;
$tokenPriceMinLocal = $tokenPriceMinUsd * $fiatPerUsd;
$tokenPriceStepLocal = $tokenPriceStepUsd * $fiatPerUsd;
$tokenPriceDefaultFormatted = number_format($tokenPriceDefaultLocal, $tokenPriceDecimals, '.', '');
$tokenPriceMinFormatted = number_format($tokenPriceMinLocal, $tokenPriceDecimals, '.', '');
$tokenPriceStepFormatted = number_format($tokenPriceStepLocal, $tokenPriceDecimals, '.', '');
$pricingLocale = (string) ($t->get('pricing.locale') ?? 'en-US');
$decimalSeparator = str_contains($pricingLocale, 'ru') ? ',' : '.';
$thousandsSeparator = str_contains($pricingLocale, 'ru') ? "\u{00a0}" : ',';
$operationsSuffix = (string) ($t->get('pricing.operations_suffix') ?? 'nERP');
$operationFiatPrefix = (string) ($t->get('pricing.operation_fiat_prefix') ?? '≈');
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
        </div>

        <figure class="illustration" aria-hidden="true">
            <img src="<?= e(asset('assets/img/hero-illustration.svg')); ?>" alt="" loading="lazy" decoding="async">
        </figure>
    </div>

    <div class="grid three feature-cards hero-feature-cards">
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

<section id="stack" class="container stack-section">
    <div class="stack-panel">
        <div class="stack-grid">
            <div class="stack-overview">
                <div class="stack-heading">
                    <h2 class="h2"><?= e($stack['title'] ?? ''); ?></h2>
                    <?php if (!empty($stack['subtitle'])): ?>
                        <p class="muted"><?= e($stack['subtitle']); ?></p>
                    <?php endif; ?>
                </div>
                <?php if ($stackHighlights !== []): ?>
                    <div class="stack-highlights">
                        <?php foreach ($stackHighlights as $item): ?>
                            <div class="card stack-highlight">
                                <div class="card-row">
                                    <div class="icon-bubble"><span class="icon <?= e($item['icon'] ?? ''); ?>" aria-hidden="true"></span></div>
                                    <div>
                                        <div class="card-title"><?= e($item['title'] ?? ''); ?></div>
                                        <div class="card-desc"><?= e($item['desc'] ?? ''); ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php
            $integrationItems = [];
            foreach ($stackIntegrations as $integration) {
                if (is_array($integration)) {
                    $integrationItems[] = [
                        'name' => (string) ($integration['name'] ?? ''),
                        'tag' => (string) ($integration['tag'] ?? ''),
                        'status' => (string) ($integration['status'] ?? ''),
                    ];
                } else {
                    $integrationItems[] = [
                        'name' => (string) $integration,
                        'tag' => '',
                        'status' => '',
                    ];
                }
            }
            ?>
            <div class="card stack-integrations">
                <div class="stack-integrations-header">
                    <div class="stack-integrations-icon" aria-hidden="true">
                        <span class="icon nodes"></span>
                    </div>
                    <div>
                        <div class="card-title"><?= e($stack['integrations_title'] ?? ''); ?></div>
                        <p class="card-desc"><?= e($stack['integrations_desc'] ?? ''); ?></p>
                    </div>
                </div>
                <?php if ($integrationItems !== []): ?>
                    <div class="integration-grid">
                        <div class="integration-core">
                            <span class="integration-core-icon" aria-hidden="true"><span class="icon shield"></span></span>
                            <div class="integration-core-label"><?= e($stack['integrations_core'] ?? 'nERP'); ?></div>
                        </div>
                        <div class="integration-lanes">
                            <?php foreach ($integrationItems as $item): ?>
                                <div class="integration-tile">
                                    <?php if ($item['status'] !== ''): ?>
                                        <span class="integration-status"><?= e($item['status']); ?></span>
                                    <?php endif; ?>
                                    <span class="integration-name"><?= e($item['name']); ?></span>
                                    <?php if ($item['tag'] !== ''): ?>
                                        <span class="integration-tag"><?= e($item['tag']); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (!empty($stack['footnote'])): ?>
                    <p class="stack-footnote"><?= e($stack['footnote']); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<div class="divider" role="presentation"></div>

<section id="pilots" class="container pilots-section">
    <div class="pilots-grid">
        <div class="pilot-overview">
            <div class="eyebrow"><?= e($t->get('pilots.eyebrow')); ?></div>
            <h2 class="h2"><?= e($t->get('pilots.title')); ?></h2>
            <p class="lead"><?= e($t->get('pilots.subtitle')); ?></p>
            <?php if (is_array($pilotPoints) && $pilotPoints !== []): ?>
                <ul class="pilot-points">
                    <?php foreach ($pilotPoints as $point): ?>
                        <li><span><?= e($point); ?></span></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
        <div class="card pilots-card">
            <h3 class="card-title"><?= e($pilotForm['title'] ?? ''); ?></h3>
            <p class="card-desc"><?= e($pilotForm['subtitle'] ?? ''); ?></p>
            <form id="pilotForm" class="pilot-form" action="<?= e($pilotForm['action'] ?? 'https://nerp.app/api/pilot-request'); ?>" method="post" data-pilot-form>
                <input type="hidden" name="locale" value="<?= e($currentLocale ?? 'ru'); ?>">
                <div class="form-grid">
                    <div class="input-control">
                        <label for="pilotName"><?= e($pilotForm['name'] ?? ''); ?></label>
                        <input type="text" id="pilotName" name="name" autocomplete="name" placeholder="<?= e($pilotForm['name_placeholder'] ?? ''); ?>" required>
                    </div>
                    <div class="input-control">
                        <label for="pilotEmail"><?= e($pilotForm['email'] ?? ''); ?></label>
                        <input type="email" id="pilotEmail" name="email" autocomplete="email" placeholder="<?= e($pilotForm['email_placeholder'] ?? ''); ?>" required>
                    </div>
                </div>
                <div class="form-grid">
                    <div class="input-control">
                        <label for="pilotCompany"><?= e($pilotForm['company'] ?? ''); ?></label>
                        <input type="text" id="pilotCompany" name="company" autocomplete="organization" placeholder="<?= e($pilotForm['company_placeholder'] ?? ''); ?>">
                    </div>
                    <div class="input-control">
                        <label for="pilotRole"><?= e($pilotForm['role'] ?? ''); ?></label>
                        <input type="text" id="pilotRole" name="role" placeholder="<?= e($pilotForm['role_placeholder'] ?? ''); ?>">
                    </div>
                </div>
                <div class="input-control">
                    <label for="pilotMessage"><?= e($pilotForm['message'] ?? ''); ?></label>
                    <textarea id="pilotMessage" name="message" rows="4" placeholder="<?= e($pilotForm['message_placeholder'] ?? ''); ?>"></textarea>
                </div>
                <p class="form-consent"><?= e($pilotForm['consent'] ?? ''); ?></p>
                <div class="pilot-form-actions">
                    <button class="btn btn-primary" type="submit">
                        <span class="icon rocket" aria-hidden="true"></span><?= e($pilotForm['submit'] ?? ''); ?>
                    </button>
                </div>
                <p class="form-message success" data-pilot-success hidden><?= e($pilotForm['success'] ?? ''); ?></p>
                <p class="form-message error" data-pilot-error hidden><?= e($pilotForm['error'] ?? ''); ?></p>
            </form>
        </div>
    </div>
</section>

<div class="divider" role="presentation"></div>

<section id="pricing" class="container pricing-section">
    <h2 class="h2"><?= e($t->get('pricing.title')); ?></h2>
    <p class="muted"><?= e($t->get('pricing.subtitle')); ?></p>
    <?php $pricingNotice = (string) ($t->get('pricing.notice') ?? ''); ?>
    <?php if ($pricingNotice !== ''): ?>
        <p class="pricing-notice"><?= e($pricingNotice); ?></p>
    <?php endif; ?>
    <div class="grid two pricing-grid">
        <div class="card calculator">
            <label for="people" class="calc-label">
                <span class="calc-label-text"><?= e($t->get('pricing.team_size')); ?></span>
                <span class="calc-label-value" id="peopleVal">50</span>
            </label>
            <input type="range" id="people" name="people" min="1" max="1000" step="1" value="50">

            <label for="apd" class="calc-label">
                <span class="calc-label-text"><?= e($t->get('pricing.actions_per_day')); ?></span>
                <span class="calc-label-value" id="apdVal">20</span>
            </label>
            <input type="range" id="apd" name="apd" min="5" max="200" step="5" value="20">

            <div class="token-price" data-token-pricing>
                <label class="token-price-label" for="tokenPriceLocal"><?= e($t->get('pricing.token_price_label')); ?></label>
                <div class="token-price-control">
                    <span class="token-price-prefix"><?= e($t->get('pricing.token_price_prefix')); ?></span>
                    <input type="number" id="tokenPriceLocal" name="tokenPriceLocal" min="<?= e($tokenPriceMinFormatted); ?>" step="<?= e($tokenPriceStepFormatted); ?>" value="<?= e($tokenPriceDefaultFormatted); ?>" data-token-input inputmode="decimal">
                    <span class="token-price-suffix"><?= e($t->get('pricing.token_price_suffix')); ?></span>
                </div>
                <div class="token-price-presets" role="group" aria-label="<?= e($t->get('pricing.token_price_presets_label')); ?>">
                    <?php foreach ($tokenPricePresets as $preset): ?>
                        <?php
                        $presetValue = number_format($preset, 2, '.', '');
                        $isActivePreset = abs($preset - $tokenPriceUsdDefault) < 0.0001;
                        ?>
                        <button type="button" class="token-preset<?= $isActivePreset ? ' active' : ''; ?>" data-token-preset="<?= e($presetValue); ?>" aria-pressed="<?= $isActivePreset ? 'true' : 'false'; ?>">
                            <span class="token-preset-value"><?= e($presetValue); ?></span>
                            <span class="token-preset-suffix"><?= e($tokenPresetCurrency); ?></span>
                        </button>
                    <?php endforeach; ?>
                </div>
                <p class="muted small token-price-hint"><?= e($t->get('pricing.token_price_hint')); ?></p>
                <p class="muted small token-price-preview"><?= e($t->get('pricing.token_price_preview_prefix')); ?> <span data-token-preview-value>—</span></p>
            </div>

            <p class="muted small"><?= e($t->get('pricing.hint')); ?></p>
        </div>
        <div class="card calc-output">
            <div class="calc-summary">
                <div class="calc-row">
                    <span><?= e($t->get('pricing.monthly_actions')); ?></span>
                    <strong id="opsMonthly">0</strong>
                </div>
                <div class="calc-row">
                    <span><?= e($t->get('pricing.nerp_total')); ?></span>
                    <strong id="nerpTotal">0</strong>
                </div>
                <div class="calc-row">
                    <span><?= e($t->get('pricing.fiat_equivalent')); ?></span>
                    <strong id="fiatApprox">0</strong>
                </div>
            </div>
            <?php if ($pricingOperations !== []): ?>
                <div class="token-operations">
                    <div class="token-operations-title"><?= e($t->get('pricing.operations_title')); ?></div>
                    <ul>
                        <?php foreach ($pricingOperations as $operation): ?>
                            <?php
                            $operationTokens = (float) ($operation['cost'] ?? 0);
                            $operationTokensRaw = number_format($operationTokens, $tokenDecimals, '.', '');
                            $operationTokensLabel = number_format($operationTokens, $tokenDecimals, $decimalSeparator, $thousandsSeparator);
                            $operationPostfix = isset($operation['postfix']) ? ' ' . (string) $operation['postfix'] : '';
                            $operationTitle = (string) ($operation['title'] ?? '');
                            ?>
                            <li>
                                <span><?= e($operationTitle); ?></span>
                                <span>
                                    <span class="token-amount"><?= e($operationTokensLabel . ' ' . $operationsSuffix . $operationPostfix); ?></span>
                                    <span class="token-fiat" data-operation-fiat="<?= e($operationTokensRaw); ?>" data-prefix="<?= e($operationFiatPrefix); ?>"><?= e($operationFiatPrefix); ?> —</span>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
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

<?php
$logosEyebrow = (string) ($logosConfig['eyebrow'] ?? '');
$logosIntro = (string) ($logosConfig['intro'] ?? '');
$defaultStory = null;
foreach ($pilotStories as $story) {
    if ($story['id'] === $defaultPilotId) {
        $defaultStory = $story;
        break;
    }
}
if ($defaultStory === null && $pilotStories !== []) {
    $defaultStory = $pilotStories[0];
}
$defaultRole = isset($defaultStory['role']) ? trim((string) $defaultStory['role']) : '';
$defaultMetric = isset($defaultStory['metric']) ? trim((string) $defaultStory['metric']) : '';
?>
<section class="container logos-section">
    <div class="grid two-66 pilot-stories">
        <div class="pilot-stories-list">
            <?php if ($logosEyebrow !== ''): ?>
                <div class="eyebrow"><?= e($logosEyebrow); ?></div>
            <?php endif; ?>
            <?php if ($logosIntro !== ''): ?>
                <p class="muted"><?= e($logosIntro); ?></p>
            <?php endif; ?>
            <?php if ($pilotStories !== []): ?>
                <div class="pilot-list" data-pilot-list>
                    <?php foreach ($pilotStories as $story): ?>
                        <?php $isActiveStory = $story['id'] === $defaultPilotId; ?>
                        <button
                            class="pilot-chip<?= $isActiveStory ? ' active' : ''; ?>"
                            type="button"
                            data-pilot-trigger
                            data-pilot-id="<?= e($story['id']); ?>"
                            data-pilot-quote="<?= e($story['quote']); ?>"
                            data-pilot-company="<?= e($story['company']); ?>"
                            data-pilot-role="<?= e($story['role']); ?>"
                            data-pilot-metric="<?= e($story['metric']); ?>"
                        >
                            <span class="pilot-chip-label"><?= e($story['label']); ?></span>
                            <?php if ($story['metric'] !== ''): ?>
                                <span class="pilot-chip-metric"><?= e($story['metric']); ?></span>
                            <?php endif; ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="card pilot-testimonial" data-pilot-display data-active-pilot="<?= e($defaultStory['id'] ?? ''); ?>">
            <div class="pilot-quote" data-pilot-quote><?= e($defaultStory['quote'] ?? ''); ?></div>
            <div class="pilot-meta">
                <div class="pilot-company" data-pilot-company><?= e($defaultStory['company'] ?? ''); ?></div>
                <div class="pilot-role" data-pilot-role<?= $defaultRole === '' ? ' hidden' : ''; ?>><?= e($defaultRole); ?></div>
                <div class="pilot-metric" data-pilot-metric<?= $defaultMetric === '' ? ' hidden' : ''; ?>><?= e($defaultMetric); ?></div>
            </div>
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
    <div class="faq" data-faq>
        <?php foreach ($faqItems as $index => $item): ?>
            <?php
            $question = (string) ($item['question'] ?? '');
            $answer = (string) ($item['answer'] ?? '');
            $isOpen = $index === 0;
            ?>
            <div class="card faq-item<?= $isOpen ? ' open' : ''; ?>" data-faq-item>
                <button class="faq-q" type="button" data-faq-question aria-expanded="<?= $isOpen ? 'true' : 'false'; ?>">
                    <span><?= e($question); ?></span>
                    <span class="faq-toggle-icon" aria-hidden="true"><span class="icon <?= $isOpen ? 'minus' : 'plus'; ?>"></span></span>
                </button>
                <div class="faq-a" data-faq-answer<?= $isOpen ? '' : ' hidden'; ?>>
                    <p><?= e($answer); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
