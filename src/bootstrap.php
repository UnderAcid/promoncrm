<?php

declare(strict_types=1);

require_once __DIR__ . '/helpers.php';

$config = app_config();

$requestedLocale = $_GET['lang'] ?? null;
$locale = resolve_locale($requestedLocale);

if ($requestedLocale && $requestedLocale !== ($_COOKIE['locale'] ?? null)) {
    setcookie('locale', $requestedLocale, [
        'expires' => time() + (365 * 24 * 60 * 60),
        'path' => '/',
        'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => false,
        'samesite' => 'Lax',
    ]);
}

$translations = load_translations($locale);
$localeConfig = supported_locales()[$locale] ?? ['dir' => 'ltr'];

