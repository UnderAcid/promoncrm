<?php

declare(strict_types=1);

namespace App;

use InvalidArgumentException;

final class View
{
    /**
     * @param array<string, mixed> $data
     */
    public static function render(string $template, array $data = []): string
    {
        $path = BASE_PATH . '/views/' . $template . '.php';
        if (!is_file($path)) {
            throw new InvalidArgumentException(sprintf('View "%s" was not found.', $template));
        }

        extract($data, EXTR_SKIP);

        ob_start();
        require $path;

        return (string) ob_get_clean();
    }
}
