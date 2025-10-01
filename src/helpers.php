<?php
declare(strict_types=1);

function resolve_locale(array $available, string $default): string
{
    $queryLang = filter_input(INPUT_GET, 'lang', FILTER_SANITIZE_SPECIAL_CHARS) ?: null;
    $cookieLang = $_COOKIE['app_lang'] ?? null;
    $preferred = $queryLang ?? $cookieLang;

    if ($preferred && array_key_exists($preferred, $available)) {
        setcookie('app_lang', $preferred, [
            'expires' => time() + 60 * 60 * 24 * 30,
            'path' => '/',
            'secure' => false,
            'httponly' => false,
            'samesite' => 'Lax',
        ]);
        return $preferred;
    }

    $browserLanguages = [];
    if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        $browserLanguages = explode(',', strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']));
    }

    foreach ($browserLanguages as $lang) {
        $code = substr(trim($lang), 0, 2);
        if (array_key_exists($code, $available)) {
            return $code;
        }
    }

    return $default;
}

function resolve_theme(): string
{
    $queryTheme = filter_input(INPUT_GET, 'theme', FILTER_SANITIZE_SPECIAL_CHARS) ?: null;
    $cookieTheme = $_COOKIE['app_theme'] ?? null;
    $theme = $queryTheme ?? $cookieTheme ?? 'auto';

    if (!in_array($theme, ['light', 'dark', 'auto'], true)) {
        $theme = 'auto';
    }

    setcookie('app_theme', $theme, [
        'expires' => time() + 60 * 60 * 24 * 30,
        'path' => '/',
        'secure' => false,
        'httponly' => false,
        'samesite' => 'Lax',
    ]);

    return $theme;
}

