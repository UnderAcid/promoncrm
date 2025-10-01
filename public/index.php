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

$audiencePitches = $translator->get('audience.pitches');
$defaultAudience = is_array($audiencePitches) ? array_key_first($audiencePitches) : 'business';

$tokenDefaultPrice = $translator->get('pricing.token_default_price');
if (!is_numeric($tokenDefaultPrice) || (float) $tokenDefaultPrice <= 0) {
    $tokenDefaultPrice = 1.0;
}

$clientConfig = [
    'defaultAudience' => $defaultAudience,
    'audiencePitches' => $audiencePitches,
    'numberLocale' => $translator->get('pricing.locale', [], $translator->get('app.locale_code')),
    'currency' => $translator->get('pricing.currency', [], 'USD'),
    'currencySymbol' => $translator->get('pricing.currency_symbol', [], '$'),
    'themes' => $themeManager->getAvailableThemes(),
    'themeLabels' => [
        'light' => $translator->get('app.theme.light'),
        'dark' => $translator->get('app.theme.dark'),
    ],
    'microFee' => 0.001,
    'tokenPrice' => (float) $tokenDefaultPrice,
];

$content = View::render('home', [
    't' => $translator,
    'currentLocale' => $localeManager->getCurrentLocale(),
]);

echo View::render('layout', [
    't' => $translator,
    'content' => $content,
    'languages' => $languages,
    'currentLocale' => $localeManager->getCurrentLocale(),
    'currentTheme' => $themeManager->getCurrentTheme(),
    'clientConfig' => $clientConfig,
    'themes' => $themeManager->getAvailableThemes(),
    'localeUrls' => $localeUrls,
]);
