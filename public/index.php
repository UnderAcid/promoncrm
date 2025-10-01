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

$themeManager = new ThemeManager(['light', 'dark', 'mezen'], 'light');

$translator = $localeManager->translator();

$audiencePitches = $translator->get('audience.pitches');
$defaultAudience = is_array($audiencePitches) ? array_key_first($audiencePitches) : 'business';

$languageOptions = [];
foreach ($languages as $code => $label) {
    $languageOptions[] = [
        'code' => $code,
        'label' => $label,
        'url' => $localeManager->getLocalizedPath($code),
        'active' => $code === $localeManager->getCurrentLocale(),
    ];
}

$clientConfig = [
    'defaultAudience' => $defaultAudience,
    'audiencePitches' => $audiencePitches,
    'numberLocale' => $translator->get('pricing.locale', [], $translator->get('app.locale_code')),
    'currency' => $translator->get('pricing.currency', [], 'USD'),
    'themes' => $themeManager->getAvailableThemes(),
    'themeLabels' => [
        'light' => $translator->get('app.theme.light'),
        'dark' => $translator->get('app.theme.dark'),
        'mezen' => $translator->get('app.theme.mezen'),
    ],
    'microFee' => 0.001,
    'usdRate' => 1,
    'pilotEndpoint' => 'https://nerp.app/api/pilots',
    'pilotSuccess' => $translator->get('pilot.success'),
    'pilotError' => $translator->get('pilot.error'),
];

$content = View::render('home', [
    't' => $translator,
    'pilotEndpoint' => $clientConfig['pilotEndpoint'],
]);

echo View::render('layout', [
    't' => $translator,
    'content' => $content,
    'languages' => $languageOptions,
    'currentLocale' => $localeManager->getCurrentLocale(),
    'currentTheme' => $themeManager->getCurrentTheme(),
    'clientConfig' => $clientConfig,
    'themes' => $themeManager->getAvailableThemes(),
]);
