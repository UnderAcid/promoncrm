<?php

declare(strict_types=1);

if (!function_exists('asset')) {
    function asset(string $path): string
    {
        $normalized = ltrim($path, '/');
        $absolute = BASE_PATH . '/public/' . $normalized;
        $version = is_file($absolute) ? (string) filemtime($absolute) : null;

        return '/' . $normalized . ($version ? '?v=' . $version : '');
    }
}

if (!function_exists('e')) {
    function e(?string $value): string
    {
        return htmlspecialchars($value ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
