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
        $requested = $_GET['lang'] ?? null;
        if (is_string($requested) && $requested !== '' && $this->isSupported($requested)) {
            $this->persistLocale($requested);

            $query = $_GET;
            unset($query['lang']);
            $queryString = http_build_query($query);

            $target = $this->buildLocalePath($requested);
            if ($queryString !== '') {
                $target .= '?' . $queryString;
            }

            header('Location: ' . $target);
            exit;
        }

        $pathLocale = $this->detectLocaleFromPath();
        if ($pathLocale !== null) {
            $currentPath = (string) (parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/');
            $expectedPath = $this->buildLocalePath($pathLocale);

            if ($currentPath !== $expectedPath) {
                $this->persistLocale($pathLocale);

                $queryString = $_SERVER['QUERY_STRING'] ?? '';
                if ($queryString !== '') {
                    $expectedPath .= '?' . $queryString;
                }

                header('Location: ' . $expectedPath);
                exit;
            }

            $this->applyLocale($pathLocale);
            return;
        }

        $stored = $_SESSION['locale'] ?? ($_COOKIE['locale'] ?? $this->default);
        $locale = is_string($stored) ? $stored : $this->default;

        if (!$this->isSupported($locale)) {
            $locale = $this->default;
        }

        if ($locale !== $this->default) {
            $this->persistLocale($locale);

            $queryString = $_SERVER['QUERY_STRING'] ?? '';
            $target = $this->buildLocalePath($locale);
            if ($queryString !== '') {
                $target .= '?' . $queryString;
            }

            header('Location: ' . $target);
            exit;
        }

        $this->applyLocale($locale);
    }

    /**
     * @return array<string, string>
     */
    public function getAvailableLocales(): array
    {
        return $this->locales;
    }

    public function getCurrentLocale(): string
    {
        return $this->current;
    }

    public function translator(): Translator
    {
        return $this->translator;
    }

    public function getLocalizedPath(string $locale): string
    {
        return $this->buildLocalePath($locale);
    }

    private function isSupported(string $locale): bool
    {
        return array_key_exists($locale, $this->locales);
    }

    private function detectLocaleFromPath(): ?string
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $parsedPath = parse_url($uri, PHP_URL_PATH);
        $path = is_string($parsedPath) ? trim($parsedPath, '/') : '';
        if ($path !== '') {
            $segments = explode('/', $path);
            $first = $segments[0] ?? '';
            if ($first !== '' && $this->isSupported($first)) {
                return $first;
            }
        }

        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        $scriptDir = trim(dirname($scriptName), '/');
        if ($scriptDir !== '' && $this->isSupported($scriptDir)) {
            return $scriptDir;
        }

        return null;
    }

    private function applyLocale(string $locale): void
    {
        if (!$this->isSupported($locale)) {
            $locale = $this->default;
        }

        $this->current = $locale;
        $this->persistLocale($locale);
        $this->translator = new Translator($locale, $this->loadLines($locale));
    }

    private function persistLocale(string $locale): void
    {
        $_SESSION['locale'] = $locale;
        if (!headers_sent()) {
            setcookie('locale', $locale, time() + 60 * 60 * 24 * 30, '/');
        }
    }

    private function buildLocalePath(string $locale): string
    {
        if (!$this->isSupported($locale) || $locale === $this->default) {
            return '/';
        }

        return '/' . $locale . '/';
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
