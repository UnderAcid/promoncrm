<?php

declare(strict_types=1);

require dirname(__DIR__, 1) . '/../bootstrap.php';

$config = get_app_config();
$locale = $_GET['lang'] ?? $config['default_locale'];
$translator = create_translator($locale);

header('Content-Type: application/json; charset=utf-8');

echo json_encode([
    'locale' => $translator->getLocale(),
    'translations' => $translator->getAll(),
    'availableLocales' => $translator->getAvailableLocales(),
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);
