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
        if (is_string($requested) && $requested !== '') {
            if ($this->isSupported($requested)) {
                $_SESSION['locale'] = $requested;
                setcookie('locale', $requested, time() + 60 * 60 * 24 * 30, '/');
            }

            $redirectTo = strtok($_SERVER['REQUEST_URI'] ?? '/', '?') ?: '/';
            header('Location: ' . $redirectTo);
            exit;
        }

        $stored = $_SESSION['locale'] ?? ($_COOKIE['locale'] ?? $this->default);
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
