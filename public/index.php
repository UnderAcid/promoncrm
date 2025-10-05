<?php

declare(strict_types=1);

require __DIR__ . '/../src/bootstrap.php';

use App\Localization\LocaleManager;
use App\Theming\ThemeManager;
use App\View;

$languages = [
    'ru' => 'Русский',
    'en' => 'English',
];

$localeManager = new LocaleManager($languages, 'ru');
$localeManager->bootstrap();
$localeUrls = $localeManager->getLocalizedPaths();

$themeManager = new ThemeManager(['light', 'dark'], 'light');

$translator = $localeManager->translator();
$baseSegments = $localeManager->getBaseSegments();
$currentLocale = $localeManager->getCurrentLocale();
$defaultLocale = $localeManager->getDefaultLocale();
$pageSlug = $baseSegments[0] ?? '';

$homePath = '/';
if ($currentLocale !== $defaultLocale) {
    $homePath = '/' . $currentLocale . '/';
}

$audiencePitches = $translator->get('audience.pitches');
$defaultAudience = is_array($audiencePitches) ? array_key_first($audiencePitches) : 'business';

$clientConfig = [
    'defaultAudience' => $defaultAudience,
    'audiencePitches' => $audiencePitches,
    'numberLocale' => $translator->get('pricing.locale', [], $translator->get('app.locale_code')),
    'currency' => $translator->get('pricing.currency', [], 'USD'),
    'themes' => $themeManager->getAvailableThemes(),
    'themeLabels' => [
        'light' => $translator->get('app.theme.light'),
        'dark' => $translator->get('app.theme.dark'),
    ],
    'microFee' => 0.001,
    'tokenPriceUsd' => (float) $translator->get('pricing.token_price_usd', [], 1.0),
    'tokenPriceDecimals' => (int) $translator->get('pricing.token_price_decimals', [], 2),
    'tokenDecimals' => (int) $translator->get('pricing.token_decimals', [], 6),
    'fiatPerUsd' => (float) $translator->get('pricing.fiat_per_usd', [], 1.0),
];

switch ($pageSlug) {
    case 'policy':
        $content = View::render('policy', [
            't' => $translator,
            'currentLocale' => $currentLocale,
        ]);
        break;
    default:
        $content = View::render('home', [
            't' => $translator,
            'currentLocale' => $currentLocale,
        ]);
        break;
}

echo View::render('layout', [
    't' => $translator,
    'content' => $content,
    'languages' => $languages,
    'currentLocale' => $currentLocale,
    'currentTheme' => $themeManager->getCurrentTheme(),
    'clientConfig' => $clientConfig,
    'themes' => $themeManager->getAvailableThemes(),
    'localeUrls' => $localeUrls,
    'homePath' => $homePath,
]);
