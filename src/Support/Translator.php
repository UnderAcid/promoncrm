<?php

declare(strict_types=1);

namespace App\Support;

final class Translator
{
    private string $locale;
    private string $fallbackLocale;
    private array $availableLocales = [];
    private array $loaded = [];

    public function __construct(string $locale, string $fallbackLocale)
    {
        $this->locale = $locale;
        $this->fallbackLocale = $fallbackLocale;
    }

    public function setAvailableLocales(array $locales): void
    {
        $this->availableLocales = $locales;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function getLocales(): array
    {
        return $this->availableLocales;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->getFromLocale($this->locale, $key) ?? $this->getFromLocale($this->fallbackLocale, $key, $default);
    }

    private function getFromLocale(string $locale, string $key, mixed $default = null): mixed
    {
        $translations = $this->loadLocale($locale);
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

    private function loadLocale(string $locale): array
    {
        if (!isset($this->loaded[$locale])) {
            $path = BASE_PATH . '/resources/lang/' . $locale . '.php';
            $this->loaded[$locale] = is_file($path) ? require $path : [];
        }

        return $this->loaded[$locale];
    }
}
