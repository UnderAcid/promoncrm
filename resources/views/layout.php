<?php
/** @var array $app */
/** @var array $meta */
/** @var array $header */
/** @var array $nav */
/** @var array $hero */
/** @var array $audience */
/** @var array $why */
/** @var array $how */
/** @var array $pricing */
/** @var array $partners */
/** @var array $logos */
/** @var array $cta */
/** @var array $faq */
/** @var array $footer */
/** @var array $appConfig */

$initialTheme = $appConfig['theme'] === 'dark' ? 'dark' : 'light';
$year = (new DateTime())->format('Y');
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($meta['lang'] ?? $appConfig['locale'], ENT_QUOTES) ?>" class="theme-<?= $initialTheme ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($meta['title'], ENT_QUOTES) ?></title>
    <meta name="description" content="<?= htmlspecialchars($meta['description'], ENT_QUOTES) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($meta['keywords'], ENT_QUOTES) ?>">
    <meta property="og:title" content="<?= htmlspecialchars($meta['og']['title'], ENT_QUOTES) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($meta['og']['description'], ENT_QUOTES) ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="<?= htmlspecialchars($meta['lang'] ?? $appConfig['locale'], ENT_QUOTES) ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" as="style">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'><text y='50' font-size='48'>n</text></svg>">
</head>
<body>
<div class="bg-root">
    <header class="header" data-component="header">
        <div class="container header-inner">
            <a class="brand" href="#top" aria-label="<?= htmlspecialchars($header['brand_name'], ENT_QUOTES) ?>">
                <span class="brand-mark"><?= htmlspecialchars($header['brand_mark'], ENT_QUOTES) ?></span>
                <span class="brand-name"><?= htmlspecialchars($header['brand_name'], ENT_QUOTES) ?></span>
            </a>
            <nav class="nav" aria-label="Primary">
                <a href="#for"><?= htmlspecialchars($nav['for'], ENT_QUOTES) ?></a>
                <a href="#why"><?= htmlspecialchars($nav['why'], ENT_QUOTES) ?></a>
                <a href="#how"><?= htmlspecialchars($nav['how'], ENT_QUOTES) ?></a>
                <a href="#pricing"><?= htmlspecialchars($nav['pricing'], ENT_QUOTES) ?></a>
                <a href="#partners"><?= htmlspecialchars($nav['partners'], ENT_QUOTES) ?></a>
                <a href="#faq"><?= htmlspecialchars($nav['faq'], ENT_QUOTES) ?></a>
            </nav>
            <div class="actions">
                <div class="dropdown" data-component="language-switcher">
                    <button class="btn btn-ghost" data-trigger="language" aria-haspopup="listbox" aria-expanded="false" aria-label="<?= htmlspecialchars($header['switch_language'], ENT_QUOTES) ?>">
                        <span class="icon globe" aria-hidden="true"></span>
                        <span data-current-language><?= htmlspecialchars($appConfig['locales'][$appConfig['locale']], ENT_QUOTES) ?></span>
                    </button>
                    <ul class="dropdown-menu" role="listbox">
                        <?php foreach ($appConfig['locales'] as $code => $label): ?>
                            <li>
                                <a href="?lang=<?= urlencode($code) ?>" role="option" data-lang="<?= htmlspecialchars($code, ENT_QUOTES) ?>">
                                    <?= htmlspecialchars($label, ENT_QUOTES) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="dropdown" data-component="theme-switcher">
                    <button class="btn btn-ghost" data-trigger="theme" aria-haspopup="listbox" aria-expanded="false" aria-label="<?= htmlspecialchars($header['switch_theme'], ENT_QUOTES) ?>">
                        <span class="icon sun" data-theme-icon aria-hidden="true"></span>
                        <span><?= htmlspecialchars($header['switch_theme'], ENT_QUOTES) ?></span>
                    </button>
                    <ul class="dropdown-menu" role="listbox">
                        <?php foreach ($appConfig['themeLabels'] as $key => $label): ?>
                            <li>
                                <button type="button" data-theme-option="<?= htmlspecialchars($key, ENT_QUOTES) ?>">
                                    <?= htmlspecialchars($label, ENT_QUOTES) ?>
                                </button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <a class="btn btn-primary" href="#pricing"><?= htmlspecialchars($header['cta'], ENT_QUOTES) ?></a>
            </div>
        </div>
    </header>

    <main id="top">
        <section class="container section-hero">
            <div class="grid two">
                <div>
                    <div class="tags">
                        <?php foreach ($hero['tags'] as $tag): ?>
                            <span class="tag"><?= htmlspecialchars($tag, ENT_QUOTES) ?></span>
                        <?php endforeach; ?>
                    </div>
                    <h1 class="h1"><?= htmlspecialchars($hero['title'], ENT_QUOTES) ?></h1>
                    <p class="lead"><?= htmlspecialchars($hero['lead'], ENT_QUOTES) ?></p>
                    <div class="cta-row">
                        <a class="btn btn-primary" href="#pricing"><span class="icon rocket" aria-hidden="true"></span><?= htmlspecialchars($hero['primary_cta'], ENT_QUOTES) ?></a>
                        <a class="btn btn-ghost" href="#how"><span class="icon play" aria-hidden="true"></span><?= htmlspecialchars($hero['secondary_cta'], ENT_QUOTES) ?></a>
                    </div>
                    <div class="grid three feature-cards">
                        <?php foreach ($hero['features'] as $feature): ?>
                            <article class="card">
                                <div class="card-row">
                                    <div class="icon-bubble"><span class="icon <?= htmlspecialchars($feature['icon'], ENT_QUOTES) ?>" aria-hidden="true"></span></div>
                                    <div>
                                        <h3 class="card-title"><?= htmlspecialchars($feature['title'], ENT_QUOTES) ?></h3>
                                        <p class="card-desc"><?= htmlspecialchars($feature['description'], ENT_QUOTES) ?></p>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="illustration" aria-hidden="true">
                    <div class="illus">
                        <div class="illus-grid">
                            <?php for ($i = 0; $i < 9; $i++): ?>
                                <div></div>
                            <?php endfor; ?>
                        </div>
                        <div class="illus-bottom">
                            <div class="illus-bar"></div>
                            <div class="illus-chip"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="divider"></div>

        <section id="for" class="container">
            <h2 class="h2"><?= htmlspecialchars($audience['title'], ENT_QUOTES) ?></h2>
            <p class="muted"><?= htmlspecialchars($audience['subtitle'], ENT_QUOTES) ?></p>
            <div class="grid three audience" data-component="audience">
                <?php foreach ($audience['cards'] as $index => $card): ?>
                    <button class="aud-card<?= $index === 0 ? ' selected' : '' ?>" data-audience="<?= htmlspecialchars($card['key'], ENT_QUOTES) ?>">
                        <div class="card-row">
                            <div class="aud-icon"><span class="icon <?= htmlspecialchars($card['icon'], ENT_QUOTES) ?>" aria-hidden="true"></span></div>
                            <div>
                                <h3 class="card-title"><?= htmlspecialchars($card['title'], ENT_QUOTES) ?></h3>
                                <p class="card-desc"><?= htmlspecialchars($card['description'], ENT_QUOTES) ?></p>
                            </div>
                        </div>
                    </button>
                <?php endforeach; ?>
            </div>
            <div class="card pitch" id="audiencePitch"></div>
        </section>

        <div class="divider"></div>

        <section id="why" class="container">
            <h2 class="h2"><?= htmlspecialchars($why['title'], ENT_QUOTES) ?></h2>
            <div class="grid three feature-cards">
                <?php foreach ($why['cards'] as $card): ?>
                    <article class="card">
                        <div class="card-row">
                            <div class="icon-bubble"><span class="icon <?= htmlspecialchars($card['icon'], ENT_QUOTES) ?>" aria-hidden="true"></span></div>
                            <div>
                                <h3 class="card-title"><?= htmlspecialchars($card['title'], ENT_QUOTES) ?></h3>
                                <p class="card-desc"><?= htmlspecialchars($card['description'], ENT_QUOTES) ?></p>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <div class="divider"></div>

        <section id="how" class="container">
            <h2 class="h2"><?= htmlspecialchars($how['title'], ENT_QUOTES) ?></h2>
            <ol class="steps">
                <?php foreach ($how['steps'] as $step): ?>
                    <li>
                        <h3><?= htmlspecialchars($step['title'], ENT_QUOTES) ?></h3>
                        <p><?= htmlspecialchars($step['description'], ENT_QUOTES) ?></p>
                    </li>
                <?php endforeach; ?>
            </ol>
        </section>

        <div class="divider"></div>

        <section id="pricing" class="container">
            <div class="grid two-66">
                <div>
                    <h2 class="h2"><?= htmlspecialchars($pricing['title'], ENT_QUOTES) ?></h2>
                    <p class="muted"><?= htmlspecialchars($pricing['subtitle'], ENT_QUOTES) ?></p>
                    <form class="card calculator" data-component="calculator">
                        <label>
                            <?= htmlspecialchars($pricing['people_label'], ENT_QUOTES) ?>
                            <input type="range" id="people" name="people" min="1" max="500" value="50">
                            <span id="peopleVal" data-output>50</span>
                        </label>
                        <label>
                            <?= htmlspecialchars($pricing['actions_label'], ENT_QUOTES) ?>
                            <input type="range" id="apd" name="apd" min="1" max="500" value="120">
                            <span id="apdVal" data-output>120</span>
                        </label>
                    </form>
                </div>
                <div class="card calculator-results">
                    <dl>
                        <div>
                            <dt><?= htmlspecialchars($pricing['actions_monthly'], ENT_QUOTES) ?></dt>
                            <dd id="opsMonthly">0</dd>
                        </div>
                        <div>
                            <dt><?= htmlspecialchars($pricing['total_nerp'], ENT_QUOTES) ?></dt>
                            <dd id="nerpTotal">0</dd>
                        </div>
                        <div>
                            <dt><?= htmlspecialchars($pricing['usd_equivalent'], ENT_QUOTES) ?></dt>
                            <dd id="usdApprox">0</dd>
                        </div>
                    </dl>
                    <a class="btn btn-primary" href="#contact"><?= htmlspecialchars($pricing['cta'], ENT_QUOTES) ?></a>
                </div>
            </div>
        </section>

        <div class="divider"></div>

        <section id="partners" class="container">
            <h2 class="h2"><?= htmlspecialchars($partners['title'], ENT_QUOTES) ?></h2>
            <div class="grid three feature-cards">
                <?php foreach ($partners['cards'] as $card): ?>
                    <article class="card">
                        <div class="card-row">
                            <div class="icon-bubble"><span class="icon <?= htmlspecialchars($card['icon'], ENT_QUOTES) ?>" aria-hidden="true"></span></div>
                            <div>
                                <h3 class="card-title"><?= htmlspecialchars($card['title'], ENT_QUOTES) ?></h3>
                                <p class="card-desc"><?= htmlspecialchars($card['description'], ENT_QUOTES) ?></p>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <div class="divider"></div>

        <section class="container logos">
            <div class="grid two-66">
                <div>
                    <p class="eyebrow"><?= htmlspecialchars($logos['eyebrow'], ENT_QUOTES) ?></p>
                    <div class="logo-grid" aria-label="<?= htmlspecialchars($logos['eyebrow'], ENT_QUOTES) ?>">
                        <?php foreach ($logos['items'] as $logo): ?>
                            <span><?= htmlspecialchars($logo, ENT_QUOTES) ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <figure class="card">
                    <blockquote class="card-desc"><?= htmlspecialchars($logos['quote'], ENT_QUOTES) ?></blockquote>
                    <figcaption class="card-title mt-8"><?= htmlspecialchars($logos['quote_author'], ENT_QUOTES) ?></figcaption>
                </figure>
            </div>
        </section>

        <div class="divider"></div>

        <section class="container center">
            <h2 class="h2"><?= htmlspecialchars($cta['title'], ENT_QUOTES) ?></h2>
            <p class="muted"><?= htmlspecialchars($cta['subtitle'], ENT_QUOTES) ?></p>
            <div class="cta-row">
                <a class="btn btn-primary" href="#contact"><span class="icon rocket" aria-hidden="true"></span><?= htmlspecialchars($cta['primary'], ENT_QUOTES) ?></a>
                <a class="btn btn-ghost" href="#how"><span class="icon play" aria-hidden="true"></span><?= htmlspecialchars($cta['secondary'], ENT_QUOTES) ?></a>
            </div>
        </section>

        <div class="divider"></div>

        <section id="faq" class="container pb-xxl">
            <h2 class="h2"><?= htmlspecialchars($faq['title'], ENT_QUOTES) ?></h2>
            <div class="faq">
                <?php foreach ($faq['items'] as $item): ?>
                    <article class="card faq-item">
                        <button class="faq-q" type="button">
                            <span><?= htmlspecialchars($item['question'], ENT_QUOTES) ?></span>
                            <span class="icon chevron" aria-hidden="true"></span>
                        </button>
                        <p class="faq-a"><?= htmlspecialchars($item['answer'], ENT_QUOTES) ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container footer-inner">
            <p><?= htmlspecialchars(str_replace(':year', $year, $footer['copyright']), ENT_QUOTES) ?></p>
            <nav class="footer-links" aria-label="Footer">
                <?php foreach ($footer['links'] as $link): ?>
                    <a href="<?= htmlspecialchars($link['href'], ENT_QUOTES) ?>"><?= htmlspecialchars($link['label'], ENT_QUOTES) ?></a>
                <?php endforeach; ?>
            </nav>
        </div>
    </footer>
</div>

<div class="floating-cta">
    <a class="btn btn-primary" href="#pricing"><span class="icon rocket" aria-hidden="true"></span><?= htmlspecialchars($header['cta'], ENT_QUOTES) ?></a>
</div>

<script>
    window.__APP_CONFIG__ = <?= json_encode($appConfig, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
</script>
<script src="/assets/js/main.js" defer></script>
</body>
</html>
