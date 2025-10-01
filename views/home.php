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
$partnerCards = $t->get('partners.cards');
$logos = $t->get('logos.brands');
$faqItems = $t->get('faq.items');
$pilotPoints = $t->get('pilots.points');
$pilotForm = $t->get('pilots.form');
$pricing = $t->get('pricing');
$pricingOperations = is_array($pricing['operations'] ?? null) ? $pricing['operations'] : [];
$pricingTokenUnit = (string) ($pricing['token_unit'] ?? 'nERP');
$pricingCurrencySymbol = (string) ($pricing['currency_symbol'] ?? '$');
$pricingTokenPattern = (string) ($pricing['token_condition'] ?? '1 :currency = :tokens');
$pricingTokenDefault = (float) ($pricing['token_default_price'] ?? 1);
if ($pricingTokenDefault <= 0) {
    $pricingTokenDefault = 1.0;
}
$tokensPerCurrency = $pricingTokenDefault > 0 ? 1 / $pricingTokenDefault : 0;
$formatTokens = static fn(float $value): string => number_format($value, 6, '.', ' ');
$pricingTokenCondition = str_replace(
    [':currency', ':tokens'],
    [$pricingCurrencySymbol, $formatTokens($tokensPerCurrency)],
    $pricingTokenPattern
);
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

<section id="stack" class="container stack-section">
    <div class="stack-surface">
        <div class="stack-grid">
            <div>
                <h2 class="h2"><?= e($stack['title'] ?? ''); ?></h2>
                <?php if (!empty($stack['subtitle'])): ?>
                    <p class="muted"><?= e($stack['subtitle']); ?></p>
                <?php endif; ?>
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
            <div class="card stack-integrations">
                <div class="card-title"><?= e($stack['integrations_title'] ?? ''); ?></div>
                <p class="card-desc"><?= e($stack['integrations_desc'] ?? ''); ?></p>
                <?php if ($stackIntegrations !== []): ?>
                    <div class="chip-grid">
                        <?php foreach ($stackIntegrations as $integration): ?>
                            <span class="chip"><?= e($integration); ?></span>
                        <?php endforeach; ?>
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
    <div class="grid two pricing-grid">
        <div class="card calculator">
            <div class="calc-group">
                <label for="people" class="calc-label">
                    <span class="calc-label-text"><?= e($t->get('pricing.team_size')); ?></span>
                    <span class="calc-label-value" id="peopleVal">50</span>
                </label>
                <input type="range" id="people" name="people" min="5" max="200" step="5" value="50">
            </div>

            <div class="calc-group">
                <label for="apd" class="calc-label">
                    <span class="calc-label-text"><?= e($t->get('pricing.actions_per_day')); ?></span>
                    <span class="calc-label-value" id="apdVal">20</span>
                </label>
                <input type="range" id="apd" name="apd" min="5" max="200" step="5" value="20">
            </div>

            <div class="calc-group">
                <div class="calc-label">
                    <span class="calc-label-text"><?= e($pricing['token_label'] ?? ''); ?></span>
                    <span class="calc-label-value token-condition" data-token-condition data-token-pattern="<?= e($pricingTokenPattern); ?>"><?= e($pricingTokenCondition); ?></span>
                </div>
                <label for="tokenPrice" class="calc-sub-label"><?= e($pricing['token_input_label'] ?? ''); ?></label>
                <div class="token-field">
                    <?php if (!empty($pricing['token_input_prefix'])): ?>
                        <span class="token-affix token-affix-prefix"><?= e($pricing['token_input_prefix']); ?></span>
                    <?php endif; ?>
                    <input type="number" id="tokenPrice" name="tokenPrice" min="0.000001" step="0.000001" value="<?= e(number_format($pricingTokenDefault, 6, '.', '')); ?>" inputmode="decimal">
                    <?php if (!empty($pricing['token_input_suffix'])): ?>
                        <span class="token-affix token-affix-suffix"><?= e($pricing['token_input_suffix']); ?></span>
                    <?php endif; ?>
                </div>
                <p class="muted small"><?= e($pricing['token_hint'] ?? ''); ?></p>
            </div>

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
                <strong id="fiatApprox"><?= e($pricingCurrencySymbol); ?>0</strong>
            </div>
            <p class="muted small"><?= e($t->get('pricing.micro_fee')); ?></p>

            <?php if ($pricingOperations !== []): ?>
                <div class="operations">
                    <div class="operations-title"><?= e($pricing['operations_title'] ?? ''); ?></div>
                    <ul class="operations-list">
                        <?php foreach ($pricingOperations as $operation): ?>
                            <?php
                            $tokens = (float) ($operation['tokens'] ?? 0);
                            $tokenText = $formatTokens($tokens) . ' ' . $pricingTokenUnit;
                            $suffix = (string) ($operation['suffix'] ?? '');
                            $fiatValue = $tokens * $pricingTokenDefault;
                            $fiatDisplay = $pricingCurrencySymbol . number_format($fiatValue, 6, '.', ' ');
                            ?>
                            <li class="operations-item" data-operation data-operation-tokens="<?= e(number_format($tokens, 6, '.', '')); ?>">
                                <span class="operations-name"><?= e($operation['label'] ?? ''); ?></span>
                                <span class="operations-values">
                                    <span class="operations-token"><?= e($tokenText . ($suffix !== '' ? ' ' . $suffix : '')); ?></span>
                                    <span class="operations-fiat" data-operation-currency>≈ <?= e($fiatDisplay); ?></span>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <p class="muted small"><?= e($pricing['operations_caption'] ?? ''); ?></p>
                </div>
            <?php endif; ?>

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
