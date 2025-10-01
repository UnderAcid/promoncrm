<?php

declare(strict_types=1);

namespace App\Localization;

final class Translator
{
    /** @var array<string, mixed> */
    private array $lines;

    public function __construct(private readonly string $locale, array $lines)
    {
        $this->lines = $lines;
    }

    public function locale(): string
    {
        return $this->locale;
    }

    /**
     * @return mixed
     */
    public function get(string $key, array $replace = [], mixed $default = null): mixed
    {
        $value = $this->lines;
        foreach (explode('.', $key) as $segment) {
            if (is_array($value) && array_key_exists($segment, $value)) {
                $value = $value[$segment];
            } else {
                return $default ?? $key;
            }
        }

        if (is_string($value) && $replace !== []) {
            foreach ($replace as $search => $replacement) {
                $value = str_replace(':' . $search, (string) $replacement, $value);
            }
        }

        return $value;
    }

    /**
     * @return array<string, mixed>
     */
    public function all(): array
    {
        return $this->lines;
    }
}
