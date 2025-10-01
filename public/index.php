<?php

declare(strict_types=1);

require __DIR__ . '/../src/bootstrap.php';

$meta = t($translations, 'meta', []);
$nav = t($translations, 'navigation', []);
$hero = t($translations, 'hero', []);
$audience = t($translations, 'audience', []);
$calculator = t($translations, 'calculator', []);
$why = t($translations, 'why', []);
$how = t($translations, 'how', []);
$partners = t($translations, 'partners', []);
$logos = t($translations, 'logos', []);
$cta = t($translations, 'cta', []);
$faq = t($translations, 'faq', []);
$footer = t($translations, 'footer', []);
$messages = t($translations, 'messages', []);
$themeTranslation = t($translations, 'theme', []);
$languageLabel = t($translations, 'language.label', 'Language');

$themeLabels = [
    'system' => $themeTranslation['system'] ?? 'System',
    'light' => $themeTranslation['light'] ?? 'Light',
    'dark' => $themeTranslation['dark'] ?? 'Dark',
    'toggle' => $themeTranslation['toggle'] ?? 'Toggle theme',
];

$locales = supported_locales();
$audienceCards = $audience['cards'] ?? [];
$audiencePitches = $audience['pitches'] ?? [];
$firstAudienceKey = array_key_first($audienceCards);
$initialPitch = ($firstAudienceKey !== null && isset($audiencePitches[$firstAudienceKey]))
    ? $audiencePitches[$firstAudienceKey]
    : null;

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$path = strtok($_SERVER['REQUEST_URI'] ?? '/', '?') ?: '/';
$canonical = $scheme . '://' . $host . $path;

$alternateLinks = [];
foreach ($locales as $code => $info) {
    $alternateLinks[$code] = $scheme . '://' . $host . url_with_locale($code);
}

$headTitle = $meta['title'] ?? 'nERP';
$headDescription = $meta['description'] ?? '';
$headKeywords = $meta['keywords'] ?? '';
$appName = t($translations, 'app.name', 'nERP');
$dir = $localeConfig['dir'] ?? 'ltr';

$scriptConfig = [
    'locale' => $locale,
    'themes' => array_values($config['themes'] ?? ['system', 'light', 'dark']),
    'themeLabels' => [
        'system' => $themeLabels['system'],
        'light' => $themeLabels['light'],
        'dark' => $themeLabels['dark'],
        'toggle' => $themeLabels['toggle'],
    ],
];

$scriptI18n = [
    'audience' => [
        'pitches' => $audiencePitches,
    ],
];

?>
<!DOCTYPE html>
<html lang="<?= e($locale) ?>" dir="<?= e($dir) ?>" data-theme="system">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($headTitle) ?></title>
    <?php if ($headDescription) : ?>
        <meta name="description" content="<?= e($headDescription) ?>">
    <?php endif; ?>
    <?php if ($headKeywords) : ?>
        <meta name="keywords" content="<?= e($headKeywords) ?>">
    <?php endif; ?>
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="<?= e($canonical) ?>">
    <?php foreach ($alternateLinks as $code => $href) : ?>
        <link rel="alternate" href="<?= e($href) ?>" hreflang="<?= e($code) ?>">
    <?php endforeach; ?>
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= e($headTitle) ?>">
    <meta property="og:description" content="<?= e($headDescription) ?>">
    <meta property="og:url" content="<?= e($canonical) ?>">
    <meta property="og:site_name" content="<?= e($appName) ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($headTitle) ?>">
    <meta name="twitter:description" content="<?= e($headDescription) ?>">
    <meta name="theme-color" content="#2563eb">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script>
        try {
            var storedTheme = localStorage.getItem('theme');
            if (storedTheme) {
                document.documentElement.dataset.theme = storedTheme;
            }
        } catch (e) {
            document.documentElement.dataset.theme = document.documentElement.dataset.theme || 'system';
        }
    </script>
    <link rel="preload" href="assets/css/app.css" as="style">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
    <script>
        window.__APP_CONFIG__ = <?= json_encode($scriptConfig, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
        window.__APP_I18N__ = <?= json_encode($scriptI18n, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
    </script>
</head>
<body>
<div class="bg-root">
    <header class="header">
        <div class="container header-inner">
            <div class="brand">
                <div class="brand-mark">n</div>
                <div class="brand-name"><?= e($appName) ?></div>
            </div>
            <?php if ($nav) : ?>
                <nav class="nav" aria-label="Main">
                    <?php foreach ($nav as $slug => $label) : ?>
                        <a href="#<?= e($slug) ?>"><?= e($label) ?></a>
                    <?php endforeach; ?>
                </nav>
            <?php endif; ?>
            <div class="actions">
                <label class="visually-hidden" for="languageSelect"><?= e($languageLabel) ?></label>
                <div class="select-wrapper">
                    <select id="languageSelect">
                        <?php foreach ($locales as $code => $info) : ?>
                            <option value="<?= e(url_with_locale($code)) ?>" <?= $code === $locale ? 'selected' : '' ?>><?= e($info['native'] ?? $info['label'] ?? $code) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button id="themeToggle" class="btn btn-ghost theme-toggle" type="button" aria-label="<?= e($themeLabels['toggle']) ?>">
                    <?= e($themeLabels['system']) ?>
                </button>
                <a class="btn btn-primary" href="#cta">
                    <?= e($hero['primary_cta'] ?? 'Start') ?>
                </a>
            </div>
        </div>
    </header>

    <main>
        <section class="container section-hero" id="top">
            <div class="grid two">
                <div>
                    <?php if (!empty($hero['tags'])) : ?>
                        <div class="tags">
                            <?php foreach ($hero['tags'] as $tag) : ?>
                                <span class="tag"><?= e($tag) ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <h1 class="h1"><?= e($hero['title'] ?? '') ?></h1>
                    <p class="lead"><?= e($hero['lead'] ?? '') ?></p>
                    <div class="cta-row">
                        <a class="btn btn-primary" href="#cta"><span class="icon rocket"></span><?= e($hero['primary_cta'] ?? '') ?></a>
                        <a class="btn btn-ghost" href="#pricing"><span class="icon play"></span><?= e($hero['secondary_cta'] ?? '') ?></a>
                    </div>

                    <?php if (!empty($hero['feature_cards'])) : ?>
                        <div class="grid three feature-cards mt-24">
                            <?php foreach ($hero['feature_cards'] as $card) : ?>
                                <div class="card">
                                    <div class="card-row">
                                        <div class="icon-bubble"><span class="icon <?= e($card['icon'] ?? '') ?>"></span></div>
                                        <div>
                                            <div class="card-title"><?= e($card['title'] ?? '') ?></div>
                                            <div class="card-desc"><?= e($card['description'] ?? '') ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="illustration">
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

        <div class="divider"></div>

        <?php if ($audience) : ?>
            <section id="<?= e($audience['id'] ?? 'for') ?>" class="container">
                <h2 class="h2"><?= e($audience['title'] ?? '') ?></h2>
                <p class="muted"><?= e($audience['description'] ?? '') ?></p>
                <div class="grid three audience">
                    <?php foreach ($audienceCards as $key => $card) : ?>
                        <?php $isSelected = $key === $firstAudienceKey; ?>
                        <button class="aud-card<?= $isSelected ? ' selected' : '' ?>" type="button" data-audience="<?= e((string) $key) ?>">
                            <div class="card-row">
                                <div class="aud-icon"><span class="icon <?= e($card['icon'] ?? '') ?>"></span></div>
                                <div>
                                    <div class="card-title"><?= e($card['title'] ?? '') ?></div>
                                    <div class="card-desc"><?= e($card['description'] ?? '') ?></div>
                                </div>
                            </div>
                        </button>
                    <?php endforeach; ?>
                </div>
                <div id="audiencePitch" class="card pitch-card">
                    <?php if ($initialPitch) : ?>
                        <div class="card-row">
                            <div class="icon-bubble"><span class="icon <?= e($initialPitch['icon'] ?? '') ?>"></span></div>
                            <div>
                                <div class="card-title"><?= e($initialPitch['title'] ?? '') ?></div>
                                <p class="card-desc"><?= e($initialPitch['description'] ?? '') ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </section>

            <div class="divider"></div>
        <?php endif; ?>

        <?php if ($why) : ?>
            <section id="<?= e($why['id'] ?? 'why') ?>" class="container">
                <h2 class="h2"><?= e($why['title'] ?? '') ?></h2>
                <div class="grid three mt-24">
                    <?php foreach (($why['cards'] ?? []) as $card) : ?>
                        <div class="card">
                            <div class="card-row">
                                <div class="icon-bubble"><span class="icon <?= e($card['icon'] ?? '') ?>"></span></div>
                                <div>
                                    <div class="card-title"><?= e($card['title'] ?? '') ?></div>
                                    <div class="card-desc"><?= e($card['description'] ?? '') ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <div class="divider"></div>
        <?php endif; ?>

        <?php if ($how) : ?>
            <section id="<?= e($how['id'] ?? 'how') ?>" class="container">
                <h2 class="h2"><?= e($how['title'] ?? '') ?></h2>
                <div class="grid two mt-24">
                    <div class="card">
                        <ul class="list">
                            <?php foreach (($how['cards'] ?? []) as $card) : ?>
                                <li>
                                    <div class="card-title"><?= e($card['title'] ?? '') ?></div>
                                    <div class="card-desc"><?= e($card['description'] ?? '') ?></div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="card">
                        <div class="diagram"><?= e($messages['diagram_placeholder'] ?? '') ?></div>
                    </div>
                </div>
            </section>

            <div class="divider"></div>
        <?php endif; ?>

        <?php if ($calculator) : ?>
            <section id="<?= e($calculator['id'] ?? 'pricing') ?>" class="container">
                <h2 class="h2"><?= e($calculator['title'] ?? '') ?></h2>
                <p class="muted"><?= e($calculator['description'] ?? '') ?></p>
                <div class="grid two mt-24">
                    <div class="card">
                        <div class="card-row mb-12"><span class="icon calculator"></span><div class="card-title"><?= e($calculator['card_title'] ?? '') ?></div></div>
                        <label class="muted small" for="people"><?= e($calculator['team_size'] ?? '') ?>: <span id="peopleVal">10</span></label>
                        <input id="people" type="range" min="1" max="500" value="10">
                        <label class="muted small mt-16" for="apd"><?= e($calculator['actions_per_day'] ?? '') ?>: <span id="apdVal">5</span></label>
                        <input id="apd" type="range" min="1" max="200" value="5">
                        <?php if (!empty($messages['calculator_hint'])) : ?>
                            <p class="muted small mt-8"><?= e($messages['calculator_hint']) ?></p>
                        <?php endif; ?>
                        <div class="grid three mt-16">
                            <div class="card stat">
                                <div class="stat-label"><?= e($calculator['monthly_operations'] ?? '') ?></div>
                                <div id="opsMonthly" class="stat-value">1 500</div>
                            </div>
                            <div class="card stat">
                                <div class="stat-label"><?= e($calculator['nerp_total'] ?? '') ?></div>
                                <div id="nerpTotal" class="stat-value">1.50</div>
                            </div>
                            <div class="card stat">
                                <div class="stat-label"><?= e($calculator['usd_approx'] ?? '') ?></div>
                                <div id="usdApprox" class="stat-value">$1.50</div>
                            </div>
                        </div>
                        <p class="fineprint"><?= e($calculator['fineprint'] ?? '') ?></p>
                    </div>
                    <div class="card">
                        <div class="card-title mb-12"><?= e($calculator['what_included_title'] ?? '') ?></div>
                        <ul class="list">
                            <?php foreach (($calculator['what_included_items'] ?? []) as $item) : ?>
                                <li><?= e($item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="mt-16">
                            <button class="btn btn-primary" type="button"><?= e($calculator['cta'] ?? '') ?></button>
                        </div>
                    </div>
                </div>
            </section>

            <div class="divider"></div>
        <?php endif; ?>

        <?php if ($partners) : ?>
            <section id="<?= e($partners['id'] ?? 'partners') ?>" class="container">
                <h2 class="h2"><?= e($partners['title'] ?? '') ?></h2>
                <div class="grid three mt-24">
                    <?php foreach (($partners['cards'] ?? []) as $card) : ?>
                        <div class="card">
                            <div class="card-row">
                                <div class="icon-bubble"><span class="icon <?= e($card['icon'] ?? '') ?>"></span></div>
                                <div>
                                    <div class="card-title"><?= e($card['title'] ?? '') ?></div>
                                    <div class="card-desc"><?= e($card['description'] ?? '') ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <div class="divider"></div>
        <?php endif; ?>

        <?php if ($logos) : ?>
            <section class="container">
                <div class="grid two-66">
                    <div>
                        <div class="eyebrow"><?= e($logos['eyebrow'] ?? '') ?></div>
                        <div class="logo-grid">
                            <?php foreach (($logos['brands'] ?? []) as $brand) : ?>
                                <div><?= e($brand) ?></div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-desc"><?= e($logos['quote'] ?? '') ?></div>
                        <div class="card-title mt-8"><?= e($logos['author'] ?? '') ?></div>
                    </div>
                </div>
            </section>

            <div class="divider"></div>
        <?php endif; ?>

        <?php if ($cta) : ?>
            <section id="cta" class="container center">
                <h2 class="h2"><?= e($cta['title'] ?? '') ?></h2>
                <p class="muted"><?= e($cta['description'] ?? '') ?></p>
                <div class="cta-row">
                    <button class="btn btn-primary" type="button"><span class="icon rocket"></span><?= e($cta['primary'] ?? '') ?></button>
                    <button class="btn btn-ghost" type="button"><span class="icon play"></span><?= e($cta['secondary'] ?? '') ?></button>
                </div>
            </section>

            <div class="divider"></div>
        <?php endif; ?>

        <?php if ($faq) : ?>
            <section id="<?= e($faq['id'] ?? 'faq') ?>" class="container pb-xxl">
                <h2 class="h2"><?= e($faq['title'] ?? '') ?></h2>
                <div class="faq">
                    <?php foreach (($faq['items'] ?? []) as $item) : ?>
                        <div class="faq-item card">
                            <button class="faq-q" type="button">
                                <span><?= e($item['question'] ?? '') ?></span>
                                <span class="icon chevron"></span>
                            </button>
                            <p class="faq-a"><?= e($item['answer'] ?? '') ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>
    </main>

    <footer class="footer">
        <div class="container footer-inner">
            <div>© <span id="year"></span> <?= e($appName) ?>. <?= e($footer['all_rights'] ?? '') ?></div>
            <div class="footer-links">
                <a href="#policy"><?= e($footer['policy'] ?? '') ?></a>
                <a href="#docs"><?= e($footer['docs'] ?? '') ?></a>
                <a href="#contacts"><?= e($footer['contacts'] ?? '') ?></a>
            </div>
        </div>
    </footer>

    <div class="floating-cta">
        <button class="btn btn-primary" type="button"><span class="icon rocket"></span><?= e($hero['primary_cta'] ?? '') ?></button>
    </div>
</div>
<script src="assets/js/app.js" defer></script>
</body>
</html>
