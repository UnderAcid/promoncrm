<?php
declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '0');

define('BASE_PATH', dirname(__DIR__));

date_default_timezone_set('UTC');

require_once __DIR__ . '/helpers.php';

spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/';
    if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
        return;
    }
    $relativeClass = substr($class, strlen($prefix));
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});

$config = require BASE_PATH . '/config/app.php';

use App\Support\Translator;

$locale = resolve_locale($config['locales'], $config['default_locale']);
$translator = new Translator($locale, $config['fallback_locale']);
$translator->setAvailableLocales($config['locales']);

$theme = resolve_theme();

$app = [
    'config' => $config,
    'translator' => $translator,
    'locale' => $locale,
    'theme' => $theme,
];

