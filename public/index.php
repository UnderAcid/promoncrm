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

$themes = ['light', 'dark'];
$themeManager = new ThemeManager($themes, 'light');

$translator = $localeManager->translator();

$audiencePitches = $translator->get('audience.pitches');
$defaultAudience = is_array($audiencePitches) ? array_key_first($audiencePitches) : 'business';

$availableThemes = $themeManager->getAvailableThemes();
$themeLabels = [];
foreach ($availableThemes as $theme) {
    $themeLabels[$theme] = $translator->get('app.theme.' . $theme);
}

$clientConfig = [
    'defaultAudience' => $defaultAudience,
    'audiencePitches' => $audiencePitches,
    'numberLocale' => $translator->get('pricing.locale', [], $translator->get('app.locale_code')),
    'currency' => $translator->get('pricing.currency', [], 'USD'),
    'themes' => $availableThemes,
    'themeLabels' => $themeLabels,
    'microFee' => 0.001,
    'usdRate' => 1,
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
    'themes' => $availableThemes,
    'localeUrls' => $localeUrls,
]);
