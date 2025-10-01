<?php

declare(strict_types=1);

namespace App\Config;

final class AppConfig
{
    public static function get(): array
    {
        return [
            'app_name' => 'nERP',
            'default_locale' => 'ru',
            'available_locales' => [
                'ru' => [
                    'label' => 'Русский',
                ],
                'en' => [
                    'label' => 'English',
                ],
            ],
            'default_theme' => 'light',
            'themes' => [
                'light' => [
                    'label' => 'Light',
                ],
                'dark' => [
                    'label' => 'Dark',
                ],
            ],
            'cookies' => [
                'locale' => 'nerp_locale',
                'theme' => 'nerp_theme',
            ],
        ];
    }
}
