<?php

declare(strict_types=1);

namespace App\Localization;

final class LocaleManager
{
    /** @var array<string, string> */
    private array $locales;

    private string $default;

    private string $current;

    private Translator $translator;

    /** @var string[] */
    private array $baseSegments = [];

    /**
     * @param array<string, string> $available
     */
    public function __construct(array $available, string $default)
    {
        $this->locales = $available;
        $this->default = array_key_exists($default, $available) ? $default : array_key_first($available);
        $this->current = $this->default;

        $this->translator = new Translator($this->default, $this->loadLines($this->default));
    }

    public function bootstrap(): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
        $segments = $this->extractSegments($path);
        $localeFromPath = $segments[0] ?? null;

        if ($localeFromPath !== null && $this->isSupported($localeFromPath)) {
            $this->baseSegments = array_slice($segments, 1);
            $this->applyLocale($localeFromPath);
        } else {
            $this->baseSegments = $segments;
            $this->applyLocale($this->determineStoredLocale());
        }

        $requested = $_GET['lang'] ?? null;
        if (is_string($requested) && $requested !== '') {
            $targetLocale = $this->isSupported($requested) ? $requested : $this->default;
            $this->applyLocale($targetLocale);

            $redirectSegments = $this->baseSegments;
            array_unshift($redirectSegments, $targetLocale);

            $redirectPath = $this->segmentsToPath($redirectSegments);
            $query = $_GET;
            unset($query['lang']);
            $redirectUrl = $redirectPath;
            if (!empty($query)) {
                $redirectUrl .= '?' . http_build_query($query);
            }

            header('Location: ' . $redirectUrl);
            exit;
        }
    }

    /**
     * @return array<string, string>
     */
    public function getAvailableLocales(): array
    {
        return $this->locales;
    }

    /**
     * @return array<string, string>
     */
    public function getLocalizedPaths(): array
    {
        $paths = [];

        foreach ($this->locales as $code => $_label) {
            $segments = $this->baseSegments;
            array_unshift($segments, $code);
            $paths[$code] = $this->segmentsToPath($segments);
        }

        return $paths;
    }

    public function getCurrentLocale(): string
    {
        return $this->current;
    }

    public function translator(): Translator
    {
        return $this->translator;
    }

    /**
     * @return string[]
     */
    public function getBaseSegments(): array
    {
        return $this->baseSegments;
    }

    public function getDefaultLocale(): string
    {
        return $this->default;
    }

    private function isSupported(string $locale): bool
    {
        return array_key_exists($locale, $this->locales);
    }

    private function applyLocale(string $locale): void
    {
        if (!$this->isSupported($locale)) {
            $locale = $this->default;
        }

        $this->current = $locale;
        $_SESSION['locale'] = $locale;
        setcookie('locale', $locale, time() + 60 * 60 * 24 * 30, '/');
        $this->translator = new Translator($locale, $this->loadLines($locale));
    }

    private function determineStoredLocale(): string
    {
        $stored = $_SESSION['locale'] ?? ($_COOKIE['locale'] ?? $this->default);
        if (is_string($stored) && $this->isSupported($stored)) {
            return $stored;
        }

        return $this->default;
    }

    /**
     * @return string[]
     */
    private function extractSegments(string $path): array
    {
        $trimmed = trim($path, '/');
        if ($trimmed === '') {
            return [];
        }

        $parts = explode('/', $trimmed);

        return array_values(array_filter($parts, static fn (string $segment): bool => $segment !== ''));
    }

    private function segmentsToPath(array $segments): string
    {
        $filtered = array_values(array_filter($segments, static fn ($segment): bool => is_string($segment) && $segment !== ''));

        if ($filtered === []) {
            return '/';
        }

        return '/' . implode('/', $filtered) . '/';
    }

    /**
     * @return array<string, mixed>
     */
    private function loadLines(string $locale): array
    {
        $path = BASE_PATH . '/translations/' . $locale . '.php';
        if (!is_file($path)) {
            return [];
        }

        /** @var array<string, mixed> $lines */
        $lines = require $path;

        return $lines;
    }
}
