<?php

declare(strict_types=1);

namespace App\Theming;

final class ThemeManager
{
    /** @var string[] */
    private array $themes;

    private string $default;

    public function __construct(array $themes, string $default = 'light')
    {
        $this->themes = $themes;
        $this->default = in_array($default, $themes, true) ? $default : ($themes[0] ?? 'light');
    }

    public function getCurrentTheme(): string
    {
        $cookie = $_COOKIE['theme'] ?? null;
        if (is_string($cookie) && in_array($cookie, $this->themes, true)) {
            return $cookie;
        }

        $prefersDark = isset($_COOKIE['prefersDark']) ? filter_var($_COOKIE['prefersDark'], FILTER_VALIDATE_BOOL) : null;
        if ($prefersDark === true && in_array('dark', $this->themes, true)) {
            return 'dark';
        }

        return $this->default;
    }

    /**
     * @return string[]
     */
    public function getAvailableThemes(): array
    {
        return $this->themes;
    }
}
