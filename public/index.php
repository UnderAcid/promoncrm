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

$pilotStatus = $_SESSION['pilot_status'] ?? null;
$pilotFormData = $_SESSION['pilot_form'] ?? null;
unset($_SESSION['pilot_status'], $_SESSION['pilot_form']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pilot_form'])) {
    $name = trim((string) ($_POST['pilot_name'] ?? ''));
    $email = trim((string) ($_POST['pilot_email'] ?? ''));
    $company = trim((string) ($_POST['pilot_company'] ?? ''));
    $message = trim((string) ($_POST['pilot_message'] ?? ''));

    $invalid = [];

    if ($name === '') {
        $invalid[] = 'name';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $invalid[] = 'email';
    }

    if ($company === '') {
        $invalid[] = 'company';
    }

    if ($message === '') {
        $invalid[] = 'message';
    }

    if ($invalid === []) {
        $payload = [
            'timestamp' => (new \DateTimeImmutable())->format(DATE_ATOM),
            'locale' => $localeManager->getCurrentLocale(),
            'name' => $name,
            'email' => $email,
            'company' => $company,
            'message' => $message,
            'ip' => $_SERVER['REMOTE_ADDR'] ?? null,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null,
        ];

        $storageDir = BASE_PATH . '/storage';
        if (!is_dir($storageDir)) {
            mkdir($storageDir, 0775, true);
        }

        @file_put_contents(
            $storageDir . '/pilot_requests.log',
            json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . PHP_EOL,
            FILE_APPEND | LOCK_EX
        );

        $_SESSION['pilot_status'] = ['status' => 'success'];
        $_SESSION['pilot_form'] = null;
    } else {
        $_SESSION['pilot_status'] = ['status' => 'error', 'fields' => $invalid];
        $_SESSION['pilot_form'] = [
            'name' => $name,
            'email' => $email,
            'company' => $company,
            'message' => $message,
        ];
    }

    $redirectPath = $localeManager->buildLocalizedPath(
        $localeManager->getCurrentLocale(),
        $localeManager->getPathWithoutLocale()
    );

    header('Location: ' . $redirectPath . '#pilots');
    exit;
}

if (!is_array($pilotFormData)) {
    $pilotFormData = [
        'name' => '',
        'email' => '',
        'company' => '',
        'message' => '',
    ];
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
        'mezen' => $translator->get('app.theme.mezen'),
    ],
    'microFee' => 0.001,
    'usdRate' => 1,
];

$localeUrls = [];
foreach ($languages as $code => $label) {
    $localeUrls[$code] = $localeManager->buildLocalizedPath($code, $localeManager->getPathWithoutLocale());
}

$content = View::render('home', [
    't' => $translator,
    'pilotStatus' => $pilotStatus,
    'pilotFormData' => $pilotFormData,
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
