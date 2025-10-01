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

$tokenPriceDefault = (float) $translator->get('pricing.token_price_default', [], 1.0);
$tokenPriceOptionsConfig = $translator->get('pricing.token_price_options');
$tokenPriceOptionsConfig = is_array($tokenPriceOptionsConfig)
    ? array_map(static fn ($value) => (float) $value, $tokenPriceOptionsConfig)
    : [1.0, 2.0, 3.0, 5.0];
$tokenPriceOptionsConfig = array_values(array_filter($tokenPriceOptionsConfig, static fn (float $value): bool => $value > 0));
if (!in_array($tokenPriceDefault, $tokenPriceOptionsConfig, true)) {
    $tokenPriceOptionsConfig[] = $tokenPriceDefault;
}
sort($tokenPriceOptionsConfig, SORT_NUMERIC);

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
    'usdPerTokenDefault' => $tokenPriceDefault,
    'usdPerTokenOptions' => $tokenPriceOptionsConfig,
    'tokenDecimals' => (int) $translator->get('pricing.token_decimals', [], 6),
    'fiatPerUsd' => (float) $translator->get('pricing.fiat_per_usd', [], 1.0),
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
