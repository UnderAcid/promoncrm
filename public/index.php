<?php
declare(strict_types=1);

require __DIR__ . '/../src/bootstrap.php';

/** @var array $app */
$translator = $app['translator'];
$locale = $app['locale'];
$theme = $app['theme'];
$config = $app['config'];

$meta = $translator->get('meta');
$header = $translator->get('header');
$nav = $translator->get('nav');
$hero = $translator->get('hero');
$audience = $translator->get('audience');
$why = $translator->get('why');
$how = $translator->get('how');
$pricing = $translator->get('pricing');
$partners = $translator->get('partners');
$logos = $translator->get('logos');
$cta = $translator->get('cta');
$faq = $translator->get('faq');
$footer = $translator->get('footer');
$themeLabels = $translator->get('theme');

$appConfig = [
    'locale' => $locale,
    'theme' => $theme,
    'locales' => $translator->getLocales(),
    'themeLabels' => $themeLabels,
    'audiencePitches' => $audience['pitches'],
    'pricing' => [
        'currency' => 'USD',
        'micro_fee' => 0.001,
        'days_per_month' => 30,
    ],
];

require BASE_PATH . '/resources/views/layout.php';
