<?php

declare(strict_types=1);

namespace App\Services;

final class TranslationService
{
    private string $locale;

    /**
     * @var array<string, array<string, string>>
     */
    private array $availableLocales;

    private string $fallbackLocale;

    /**
     * @var array<string, mixed>
     */
    private array $translations;

    public function __construct(string $locale, array $config)
    {
        $this->availableLocales = $config['available_locales'] ?? [];
        $this->fallbackLocale = $config['default_locale'] ?? 'en';
        $this->setLocale($locale);
    }

    public function setLocale(string $locale): void
    {
        $locale = $this->sanitizeLocale($locale);
        $this->locale = $locale;
        $this->translations = $this->loadTranslations($locale);
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @return array<string, array<string, string>>
     */
    public function getAvailableLocales(): array
    {
        return $this->availableLocales;
    }

    /**
     * @return array<string, mixed>
     */
    public function getAll(?string $locale = null): array
    {
        if ($locale === null) {
            return $this->translations;
        }

        $locale = $this->sanitizeLocale($locale);

        return $this->loadTranslations($locale);
    }

    /**
     * @return string|array<mixed>
     */
    public function get(string $key, array $replace = [])
    {
        $value = $this->resolveKey($key, $this->translations);

        if ($value === null) {
            $fallbackTranslations = $this->loadTranslations($this->fallbackLocale);
            $value = $this->resolveKey($key, $fallbackTranslations);
        }

        if ($value === null) {
            return $key;
        }

        if (is_string($value)) {
            return $this->applyReplacements($value, $replace);
        }

        return $value;
    }

    private function sanitizeLocale(string $locale): string
    {
        $locale = strtolower(trim($locale));

        if ($locale === '') {
            return $this->fallbackLocale;
        }

        if (!array_key_exists($locale, $this->availableLocales)) {
            return $this->fallbackLocale;
        }

        return $locale;
    }

    /**
     * @return array<string, mixed>
     */
    private function loadTranslations(string $locale): array
    {
        $path = base_path('resources/lang/' . $locale . '.php');

        if (!is_file($path)) {
            $locale = $this->fallbackLocale;
            $path = base_path('resources/lang/' . $locale . '.php');
        }

        /** @var array<string, mixed> $translations */
        $translations = require $path;

        return $translations;
    }

    /**
     * @param array<string, mixed> $data
     */
    private function resolveKey(string $key, array $data)
    {
        $segments = explode('.', $key);
        $value = $data;

        foreach ($segments as $segment) {
            if (!is_array($value) || !array_key_exists($segment, $value)) {
                return null;
            }

            $value = $value[$segment];
        }

        return $value;
    }

    private function applyReplacements(string $value, array $replace): string
    {
        $replacements = [];
        foreach ($replace as $key => $replacement) {
            $replacements['%' . $key . '%'] = (string) $replacement;
        }

        if ($replacements === []) {
            return $value;
        }

        return strtr($value, $replacements);
    }
}
