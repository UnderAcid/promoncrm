<?php

declare(strict_types=1);

require dirname(__DIR__) . '/bootstrap.php';

$config = get_app_config();
$localeCookie = $config['cookies']['locale'];
$themeCookie = $config['cookies']['theme'];

$requestedLocale = $_GET['lang'] ?? ($_COOKIE[$localeCookie] ?? $config['default_locale']);
$translator = create_translator($requestedLocale);
$locale = $translator->getLocale();

if (!headers_sent()) {
    setcookie($localeCookie, $locale, time() + 365 * 24 * 60 * 60, '/', '', false, false);
}

$requestedTheme = $_COOKIE[$themeCookie] ?? $config['default_theme'];
$theme = array_key_exists($requestedTheme, $config['themes']) ? $requestedTheme : $config['default_theme'];

$meta = $translator->get('meta');
$navLinks = [
    ['href' => '#for', 'key' => 'nav.for'],
    ['href' => '#why', 'key' => 'nav.why'],
    ['href' => '#how', 'key' => 'nav.how'],
    ['href' => '#pricing', 'key' => 'nav.pricing'],
    ['href' => '#partners', 'key' => 'nav.partners'],
    ['href' => '#faq', 'key' => 'nav.faq'],
];
$heroFeatures = $translator->get('hero.features');
$audienceCards = $translator->get('audience.cards');
$audiencePitches = $translator->get('audience.pitches');
$whyItems = $translator->get('why.items');
$howSteps = $translator->get('how.steps');
$pricingLabels = $translator->get('pricing.labels');
$pricingIncluded = $translator->get('pricing.included');
$partnerItems = $translator->get('partners.items');
$logos = $translator->get('logos');
$faqItems = $translator->get('faq.items');
$footerLinks = $translator->get('footer.links');
$year = (int) date('Y');
$defaultAudience = 'business';
$appConfigForClient = [
    'locale' => $locale,
    'defaultLocale' => $config['default_locale'],
    'availableLocales' => $translator->getAvailableLocales(),
    'translations' => $translator->getAll(),
    'themes' => $config['themes'],
    'theme' => $theme,
    'cookies' => $config['cookies'],
];
$jsonOptions = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT;
?>
<!DOCTYPE html>
<html lang="<?= escape($locale) ?>" data-theme="<?= escape($theme) ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= escape($meta['title'] ?? $config['app_name']) ?></title>
    <?php if (!empty($meta['description'])): ?>
        <meta name="description" content="<?= escape($meta['description']) ?>">
    <?php endif; ?>
    <?php if (!empty($meta['keywords'])): ?>
        <meta name="keywords" content="<?= escape($meta['keywords']) ?>">
    <?php endif; ?>
    <?php if (!empty($meta['og']['title'])): ?>
        <meta property="og:title" content="<?= escape($meta['og']['title']) ?>">
    <?php endif; ?>
    <?php if (!empty($meta['og']['description'])): ?>
        <meta property="og:description" content="<?= escape($meta['og']['description']) ?>">
    <?php endif; ?>
    <meta property="og:type" content="website">
    <meta property="og:locale" content="<?= escape(str_replace('-', '_', $locale)) ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'><circle cx='32' cy='32' r='32' fill='%23007aff'/><text x='32' y='40' font-size='32' text-anchor='middle' fill='white' font-family='Inter,Arial,sans-serif'>n</text></svg>">
    <script id="app-config" type="application/json"><?= json_encode($appConfigForClient, $jsonOptions) ?></script>
</head>
<body>
<div class="bg-root">
    <header class="header">
        <div class="container header-inner">
            <div class="brand" aria-label="<?= escape($config['app_name']) ?>">
                <div class="brand-mark">n</div>
                <div class="brand-name"><?= escape($config['app_name']) ?></div>
            </div>
            <nav class="nav" aria-label="Main navigation">
                <?php foreach ($navLinks as $link): ?>
                    <a href="<?= escape($link['href']) ?>" data-i18n-key="<?= escape($link['key']) ?>"><?= escape($translator->get($link['key'])) ?></a>
                <?php endforeach; ?>
            </nav>
            <div class="actions">
                <label class="select">
                    <span class="select-label" data-i18n-key="common.language_label"><?= escape($translator->get('common.language_label')) ?></span>
                    <select id="languageSwitcher" aria-label="<?= escape($translator->get('common.language_label')) ?>">
                        <?php foreach ($translator->getAvailableLocales() as $code => $localeData): ?>
                            <option value="<?= escape($code) ?>" <?= $code === $locale ? 'selected' : '' ?>><?= escape($localeData['label'] ?? strtoupper($code)) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <button id="themeToggle" class="btn btn-ghost" type="button" data-i18n-theme="<?= escape($theme) ?>">
                    <span class="icon theme"></span>
                    <span data-i18n-key="common.theme_toggle.<?= escape($theme) ?>">
                        <?= escape($translator->get('common.theme_toggle.' . $theme)) ?>
                    </span>
                </button>
                <a href="#pricing" class="btn btn-primary" data-i18n-key="actions.try"><?= escape($translator->get('actions.try')) ?></a>
            </div>
        </div>
    </header>

    <main>
        <section class="container section-hero">
            <div class="grid two">
                <div>
                    <div class="tags">
                        <?php foreach ($translator->get('hero.tags') as $tagKey => $tagLabel): ?>
                            <span class="tag" data-i18n-key="hero.tags.<?= escape($tagKey) ?>"><?= escape($tagLabel) ?></span>
                        <?php endforeach; ?>
                    </div>
                    <h1 class="h1" data-i18n-key="hero.title"><?= escape($translator->get('hero.title')) ?></h1>
                    <p class="lead" data-i18n-key="hero.description"><?= escape($translator->get('hero.description')) ?></p>
                    <div class="cta-row">
                        <a class="btn btn-primary" href="#pricing">
                            <span class="icon rocket"></span>
                            <span data-i18n-key="hero.cta_primary"><?= escape($translator->get('hero.cta_primary')) ?></span>
                        </a>
                        <button class="btn btn-ghost" type="button">
                            <span class="icon play"></span>
                            <span data-i18n-key="hero.cta_secondary"><?= escape($translator->get('hero.cta_secondary')) ?></span>
                        </button>
                    </div>
                    <div class="grid three feature-cards">
                        <?php foreach ($heroFeatures as $key => $feature): ?>
                            <div class="card" data-feature="<?= escape($key) ?>">
                                <div class="card-row">
                                    <div class="icon-bubble"><span class="icon <?= escape($feature['icon']) ?>"></span></div>
                                    <div>
                                        <div class="card-title" data-i18n-key="hero.features.<?= escape($key) ?>.title"><?= escape($feature['title']) ?></div>
                                        <div class="card-desc" data-i18n-key="hero.features.<?= escape($key) ?>.description"><?= escape($feature['description']) ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="illustration" aria-hidden="true">
                    <div class="illus">
                        <div class="illus-grid">
                            <?php for ($i = 0; $i < 9; $i++): ?>
                                <div></div>
                            <?php endfor; ?>
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

        <section id="for" class="container">
            <h2 class="h2" data-i18n-key="audience.title"><?= escape($translator->get('audience.title')) ?></h2>
            <p class="muted" data-i18n-key="audience.subtitle"><?= escape($translator->get('audience.subtitle')) ?></p>
            <div class="grid three audience">
                <?php foreach ($audienceCards as $key => $card): ?>
                    <button class="aud-card<?= $key === $defaultAudience ? ' selected' : '' ?>" type="button" data-audience="<?= escape($key) ?>">
                        <div class="card-row">
                            <div class="aud-icon"><span class="icon <?= escape($audiencePitches[$key]['icon']) ?>"></span></div>
                            <div>
                                <div class="card-title" data-i18n-key="audience.cards.<?= escape($key) ?>.title"><?= escape($card['title']) ?></div>
                                <div class="card-desc" data-i18n-key="audience.cards.<?= escape($key) ?>.description"><?= escape($card['description']) ?></div>
                            </div>
                        </div>
                    </button>
                <?php endforeach; ?>
            </div>
            <?php $defaultPitch = $audiencePitches[$defaultAudience]; ?>
            <div id="audiencePitch" class="card mt-16" data-current="<?= escape($defaultAudience) ?>">
                <div class="card-row">
                    <div class="icon-bubble"><span class="icon <?= escape($defaultPitch['icon']) ?>"></span></div>
                    <div>
                        <div class="card-title" data-i18n-key="audience.pitches.<?= escape($defaultAudience) ?>.title"><?= escape($defaultPitch['title']) ?></div>
                        <p class="card-desc" data-i18n-key="audience.pitches.<?= escape($defaultAudience) ?>.description"><?= escape($defaultPitch['description']) ?></p>
                    </div>
                </div>
            </div>
        </section>

        <div class="divider" role="presentation"></div>

        <section id="why" class="container">
            <h2 class="h2" data-i18n-key="why.title"><?= escape($translator->get('why.title')) ?></h2>
            <div class="grid three">
                <?php foreach ($whyItems as $index => $item): ?>
                    <div class="card" data-why="<?= (int) $index ?>">
                        <div class="card-row">
                            <div class="icon-bubble"><span class="icon <?= escape($item['icon']) ?>"></span></div>
                            <div>
                                <div class="card-title" data-i18n-key="why.items.<?= (int) $index ?>.title"><?= escape($item['title']) ?></div>
                                <div class="card-desc" data-i18n-key="why.items.<?= (int) $index ?>.description"><?= escape($item['description']) ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <div class="divider" role="presentation"></div>

        <section id="how" class="container">
            <h2 class="h2" data-i18n-key="how.title"><?= escape($translator->get('how.title')) ?></h2>
            <div class="grid two">
                <ol class="steps">
                    <?php foreach ($howSteps as $index => $step): ?>
                        <li>
                            <div class="step-num"><?= (int) $index + 1 ?></div>
                            <div>
                                <div class="card-title" data-i18n-key="how.steps.<?= (int) $index ?>.title"><?= escape($step['title']) ?></div>
                                <p class="card-desc" data-i18n-key="how.steps.<?= (int) $index ?>.description"><?= escape($step['description']) ?></p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ol>
                <div class="card diagram" data-i18n-key="how.diagram"><?= escape($translator->get('how.diagram')) ?></div>
            </div>
        </section>

        <div class="divider" role="presentation"></div>

        <section id="pricing" class="container">
            <h2 class="h2" data-i18n-key="pricing.title"><?= escape($translator->get('pricing.title')) ?></h2>
            <p class="muted" data-i18n-key="pricing.subtitle"><?= escape($translator->get('pricing.subtitle')) ?></p>
            <div class="grid two">
                <div class="card">
                    <div class="card-row mb-12">
                        <span class="icon calculator"></span>
                        <div class="card-title" data-i18n-key="pricing.calculator"><?= escape($translator->get('pricing.calculator')) ?></div>
                    </div>
                    <label class="muted small">
                        <span data-i18n-key="pricing.labels.employees"><?= escape($pricingLabels['employees']) ?></span>: <span id="peopleVal">10</span>
                    </label>
                    <input id="people" type="range" min="1" max="500" value="10" />
                    <label class="muted small mt-16">
                        <span data-i18n-key="pricing.labels.actions_per_day"><?= escape($pricingLabels['actions_per_day']) ?></span>: <span id="apdVal">5</span>
                    </label>
                    <input id="apd" type="range" min="1" max="200" value="5" />

                    <div class="grid three mt-16">
                        <div class="card stat">
                            <div class="stat-label" data-i18n-key="pricing.labels.operations_monthly"><?= escape($pricingLabels['operations_monthly']) ?></div>
                            <div id="opsMonthly" class="stat-value">1&nbsp;500</div>
                        </div>
                        <div class="card stat">
                            <div class="stat-label" data-i18n-key="pricing.labels.nerp_tokens"><?= escape($pricingLabels['nerp_tokens']) ?></div>
                            <div id="nerpTotal" class="stat-value">1.50</div>
                        </div>
                        <div class="card stat">
                            <div class="stat-label" data-i18n-key="pricing.labels.usd_equivalent"><?= escape($pricingLabels['usd_equivalent']) ?></div>
                            <div id="usdApprox" class="stat-value">$1.50</div>
                        </div>
                    </div>
                    <p class="fineprint" data-i18n-key="pricing.labels.fineprint"><?= escape($pricingLabels['fineprint']) ?></p>
                </div>
                <div class="card">
                    <div class="card-title" data-i18n-key="pricing.included.title"><?= escape($pricingIncluded['title']) ?></div>
                    <ul class="list">
                        <?php foreach ($pricingIncluded['items'] as $index => $item): ?>
                            <li data-i18n-key="pricing.included.items.<?= (int) $index ?>"><?= escape($item) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="mt-16">
                        <a class="btn btn-primary" href="#contact" data-i18n-key="pricing.included.cta"><?= escape($pricingIncluded['cta']) ?></a>
                    </div>
                </div>
            </div>
        </section>

        <div class="divider" role="presentation"></div>

        <section id="partners" class="container">
            <h2 class="h2" data-i18n-key="partners.title"><?= escape($translator->get('partners.title')) ?></h2>
            <div class="grid three">
                <?php foreach ($partnerItems as $index => $item): ?>
                    <div class="card" data-partner="<?= (int) $index ?>">
                        <div class="card-row">
                            <div class="icon-bubble"><span class="icon <?= escape($item['icon']) ?>"></span></div>
                            <div>
                                <div class="card-title" data-i18n-key="partners.items.<?= (int) $index ?>.title"><?= escape($item['title']) ?></div>
                                <div class="card-desc" data-i18n-key="partners.items.<?= (int) $index ?>.description"><?= escape($item['description']) ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <div class="divider" role="presentation"></div>

        <section class="container">
            <div class="grid two-66">
                <div>
                    <div class="eyebrow" data-i18n-key="logos.eyebrow"><?= escape($logos['eyebrow']) ?></div>
                    <div class="logo-grid" aria-label="<?= escape($translator->get('logos.eyebrow')) ?>">
                        <?php foreach ($logos['brands'] as $brand): ?>
                            <div><?= escape($brand) ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="card">
                    <div class="card-desc" data-i18n-key="logos.quote.text"><?= escape($logos['quote']['text']) ?></div>
                    <div class="card-title mt-8" data-i18n-key="logos.quote.author"><?= escape($logos['quote']['author']) ?></div>
                </div>
            </div>
        </section>

        <div class="divider" role="presentation"></div>

        <section class="container center">
            <h2 class="h2" data-i18n-key="cta.title"><?= escape($translator->get('cta.title')) ?></h2>
            <p class="muted" data-i18n-key="cta.subtitle"><?= escape($translator->get('cta.subtitle')) ?></p>
            <div class="cta-row">
                <a class="btn btn-primary" href="#pricing">
                    <span class="icon rocket"></span>
                    <span data-i18n-key="cta.primary"><?= escape($translator->get('cta.primary')) ?></span>
                </a>
                <button class="btn btn-ghost" type="button">
                    <span class="icon play"></span>
                    <span data-i18n-key="cta.secondary"><?= escape($translator->get('cta.secondary')) ?></span>
                </button>
            </div>
        </section>

        <div class="divider" role="presentation"></div>

        <section id="faq" class="container pb-xxl">
            <h2 class="h2" data-i18n-key="faq.title"><?= escape($translator->get('faq.title')) ?></h2>
            <div class="faq">
                <?php foreach ($faqItems as $index => $item): ?>
                    <div class="card faq-item" data-faq="<?= (int) $index ?>">
                        <button class="faq-q" type="button">
                            <span data-i18n-key="faq.items.<?= (int) $index ?>.question"><?= escape($item['question']) ?></span>
                            <span class="icon chevron"></span>
                        </button>
                        <p class="faq-a" data-i18n-key="faq.items.<?= (int) $index ?>.answer"><?= escape($item['answer']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container footer-inner">
            <div data-i18n-key="footer.copyright" data-i18n-replace-year="<?= $year ?>">
                <?= escape($translator->get('footer.copyright', ['year' => $year])) ?>
            </div>
            <div class="footer-links">
                <?php foreach ($footerLinks as $index => $link): ?>
                    <a href="<?= escape($link['href']) ?>" data-i18n-key="footer.links.<?= (int) $index ?>.label"><?= escape($link['label']) ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </footer>

    <div class="floating-cta">
        <a class="btn btn-primary" href="#pricing">
            <span class="icon rocket"></span>
            <span data-i18n-key="actions.floating"><?= escape($translator->get('actions.floating')) ?></span>
        </a>
    </div>
</div>

<script src="assets/js/i18n.js" defer></script>
<script src="assets/js/theme.js" defer></script>
<script src="assets/js/app.js" defer></script>
</body>
</html>
