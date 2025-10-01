<?php

declare(strict_types=1);

function app_config(): array
{
    static $config;
    if ($config === null) {
        $config = require __DIR__ . '/../config/app.php';
    }

    return $config;
}

function supported_locales(): array
{
    return app_config()['locales'] ?? [];
}

function resolve_locale(?string $requested = null): string
{
    $config = app_config();
    $default = $config['default_locale'] ?? 'en';
    $locales = supported_locales();

    if ($requested && isset($locales[$requested])) {
        return $requested;
    }

    if (isset($_COOKIE['locale']) && isset($locales[$_COOKIE['locale']])) {
        return $_COOKIE['locale'];
    }

    $accept = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '';
    if ($accept) {
        $accepted = explode(',', $accept);
        foreach ($accepted as $locale) {
            $locale = strtolower(trim(explode(';', $locale)[0]));
            if (isset($locales[$locale])) {
                return $locale;
            }
            $short = substr($locale, 0, 2);
            if (isset($locales[$short])) {
                return $short;
            }
        }
    }

    return $default;
}

function load_translations(string $locale): array
{
    $basePath = __DIR__ . '/../resources/lang/';
    $translations = [];
    $fallback = app_config()['fallback_locale'] ?? null;

    if ($fallback && file_exists($basePath . $fallback . '.php')) {
        /** @var array $translations */
        $translations = require $basePath . $fallback . '.php';
    }

    $path = $basePath . $locale . '.php';
    if (file_exists($path)) {
        /** @var array $localeTranslations */
        $localeTranslations = require $path;
        $translations = array_replace_recursive($translations, $localeTranslations);
    }

    return $translations;
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function t(array $translations, string $key, mixed $default = null): mixed
{
    if ($key === '') {
        return $translations;
    }

    $segments = explode('.', $key);
    $value = $translations;
    foreach ($segments as $segment) {
        if (!is_array($value) || !array_key_exists($segment, $value)) {
            return $default;
        }
        $value = $value[$segment];
    }

    return $value;
}

function url_with_locale(string $locale): string
{
    $query = $_GET;
    $query['lang'] = $locale;
    $path = strtok($_SERVER['REQUEST_URI'] ?? '/', '?') ?: '/';
    $qs = http_build_query($query);

    return $qs ? $path . '?' . $qs : $path;
}

