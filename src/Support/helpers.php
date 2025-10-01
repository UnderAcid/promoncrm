<?php

declare(strict_types=1);

use App\Config\AppConfig;
use App\Services\TranslationService;

if (!function_exists('base_path')) {
    function base_path(string $path = ''): string
    {
        $path = ltrim($path, '/');

        return BASE_PATH . ($path !== '' ? '/' . $path : '');
    }
}

if (!function_exists('public_path')) {
    function public_path(string $path = ''): string
    {
        return base_path('public' . ($path !== '' ? '/' . ltrim($path, '/') : ''));
    }
}

if (!function_exists('escape')) {
    function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

if (!function_exists('get_app_config')) {
    function get_app_config(): array
    {
        return AppConfig::get();
    }
}

if (!function_exists('create_translator')) {
    function create_translator(string $locale): TranslationService
    {
        return new TranslationService($locale, get_app_config());
    }
}
