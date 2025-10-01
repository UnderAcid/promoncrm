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
        $path = strtok($_SERVER['REQUEST_URI'] ?? '/', '?') ?: '/';
        $segments = array_values(array_filter(explode('/', $path), static fn ($part) => $part !== ''));

        $pathLocale = null;
        if (isset($segments[0]) && $this->isSupported($segments[0])) {
            $pathLocale = $segments[0];
        }

        $remainingSegments = $pathLocale !== null ? array_slice($segments, 1) : $segments;

        $requested = $_GET['lang'] ?? null;
        if (is_string($requested) && $requested !== '') {
            $targetLocale = $this->isSupported($requested) ? $requested : $this->default;
            $this->rememberLocale($targetLocale);

            $redirectTo = $this->buildLocalePath($targetLocale, $remainingSegments);
            header('Location: ' . $redirectTo);
            exit;
        }

        if ($pathLocale !== null) {
            $locale = $pathLocale;
            $this->rememberLocale($locale);
            $targetPath = $this->buildLocalePath($locale, $remainingSegments);
            if ($targetPath !== $path) {
                header('Location: ' . $targetPath);
                exit;
            }
        } else {
            $stored = $_SESSION['locale'] ?? ($_COOKIE['locale'] ?? $this->default);
            $locale = is_string($stored) && $this->isSupported($stored) ? $stored : $this->default;
            $this->rememberLocale($locale);

            $redirectTo = $this->buildLocalePath($locale, $remainingSegments);
            if ($redirectTo !== $path) {
                header('Location: ' . $redirectTo);
                exit;
            }
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

    private function isSupported(string $locale): bool
    {
        return array_key_exists($locale, $this->locales);
    }

    private function rememberLocale(string $locale): void
    {
        $_SESSION['locale'] = $locale;
        setcookie('locale', $locale, time() + 60 * 60 * 24 * 30, '/');
    }

    /**
     * @param string[] $segments
     */
    private function buildLocalePath(string $locale, array $segments): string
    {
        if ($segments !== []) {
            return '/' . $locale . '/' . implode('/', $segments);
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
