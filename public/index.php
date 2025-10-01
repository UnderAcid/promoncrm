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

$pilotForm = [
    'values' => [
        'name' => '',
        'email' => '',
        'company' => '',
        'message' => '',
    ],
    'errors' => [],
    'success' => false,
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['form'] ?? '') === 'pilot') {
    $name = trim((string) ($_POST['name'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $company = trim((string) ($_POST['company'] ?? ''));
    $message = trim((string) ($_POST['message'] ?? ''));

    $pilotForm['values'] = compact('name', 'email', 'company', 'message');

    if ($name === '') {
        $pilotForm['errors']['name'] = $translator->get('pilots.errors.required');
    }

    if ($email === '') {
        $pilotForm['errors']['email'] = $translator->get('pilots.errors.required');
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $pilotForm['errors']['email'] = $translator->get('pilots.errors.email');
    }

    if ($company === '') {
        $pilotForm['errors']['company'] = $translator->get('pilots.errors.required');
    }

    if ($message === '') {
        $pilotForm['errors']['message'] = $translator->get('pilots.errors.required');
    }

    if ($pilotForm['errors'] === []) {
        $storageDir = BASE_PATH . '/storage';
        if (!is_dir($storageDir) && !mkdir($storageDir, 0775, true) && !is_dir($storageDir)) {
            $pilotForm['errors']['general'] = $translator->get('pilots.errors.general');
        } else {
            $entry = [
                'timestamp' => date('c'),
                'locale' => $localeManager->getCurrentLocale(),
                'name' => $name,
                'email' => $email,
                'company' => $company,
                'message' => $message,
                'ip' => $_SERVER['REMOTE_ADDR'] ?? null,
            ];

            $result = @file_put_contents(
                $storageDir . '/pilot_requests.jsonl',
                json_encode($entry, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . PHP_EOL,
                FILE_APPEND | LOCK_EX
            );

            if ($result === false) {
                $pilotForm['errors']['general'] = $translator->get('pilots.errors.general');
            } else {
                $pilotForm['success'] = true;
                $pilotForm['values'] = [
                    'name' => '',
                    'email' => '',
                    'company' => '',
                    'message' => '',
                ];
            }
        }
    }
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

$content = View::render('home', [
    't' => $translator,
    'pilotForm' => $pilotForm,
]);

echo View::render('layout', [
    't' => $translator,
    'content' => $content,
    'languages' => $languages,
    'currentLocale' => $localeManager->getCurrentLocale(),
    'currentTheme' => $themeManager->getCurrentTheme(),
    'clientConfig' => $clientConfig,
    'themes' => $themeManager->getAvailableThemes(),
]);
