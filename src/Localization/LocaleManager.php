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

    private ?string $pathLocale = null;

    private string $pathWithoutLocale = '/';

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

        $path = (string) parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        if ($path === '') {
            $path = '/';
        }

        $segments = array_values(array_filter(
            explode('/', $path),
            static fn (string $segment): bool => $segment !== ''
        ));

        $this->pathLocale = null;

        if ($segments !== []) {
            $candidate = $segments[0];
            if ($this->isSupported($candidate)) {
                $this->pathLocale = $candidate;
                array_shift($segments);
            }
        }

        $endsWithSlash = str_ends_with($path, '/');
        if ($segments === []) {
            $this->pathWithoutLocale = $endsWithSlash ? '/' : '/';
        } else {
            $joined = implode('/', $segments);
            $this->pathWithoutLocale = '/' . $joined;
            if ($endsWithSlash) {
                $this->pathWithoutLocale .= '/';
            }
        }

        if ($requested !== null) {
            $requestedLocale = is_string($requested) ? $requested : '';
            $redirectLocale = $this->isSupported($requestedLocale) ? $requestedLocale : $this->default;

            if ($this->isSupported($redirectLocale)) {
                $_SESSION['locale'] = $redirectLocale;
                setcookie('locale', $redirectLocale, time() + 60 * 60 * 24 * 30, '/');
            }

            $query = $_GET;
            unset($query['lang']);

            $redirectPath = $this->buildLocalizedPath($redirectLocale, $this->pathWithoutLocale);
            if ($query !== []) {
                $redirectPath .= '?' . http_build_query($query);
            }

            header('Location: ' . $redirectPath);
            exit;
        }

        $stored = $this->pathLocale ?? ($_SESSION['locale'] ?? ($_COOKIE['locale'] ?? $this->default));
        $locale = is_string($stored) ? $stored : $this->default;

        if (!$this->isSupported($locale)) {
            $locale = $this->default;
        }

        $this->current = $locale;
        $this->translator = new Translator($locale, $this->loadLines($locale));
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

    public function getPathWithoutLocale(): string
    {
        return $this->pathWithoutLocale;
    }

    public function buildLocalizedPath(string $locale, string $suffix = '/'): string
    {
        $locale = trim($locale, '/');
        if ($locale === '' || !$this->isSupported($locale)) {
            $locale = $this->default;
        }

        $suffix = $suffix === '' ? '/' : $suffix;
        $normalizedSuffix = '/' . ltrim($suffix, '/');
        if ($normalizedSuffix !== '/' && str_ends_with($normalizedSuffix, '/')) {
            $normalizedSuffix = rtrim($normalizedSuffix, '/');
        }

        $path = '/' . $locale;
        if ($normalizedSuffix === '/') {
            $path .= '/';
        } else {
            $path .= $normalizedSuffix;
        }

        return $path;
    }

    private function isSupported(string $locale): bool
    {
        return array_key_exists($locale, $this->locales);
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
