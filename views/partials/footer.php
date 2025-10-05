<?php
/** @var App\Localization\Translator $t */
/** @var array<string, string> $routeUrls */
?>
<footer class="footer">
    <div class="container footer-inner">
        <div><?= e($t->get('footer.copyright', ['year' => date('Y')])); ?></div>
        <div class="footer-links">
            <?php foreach ($t->get('footer.links') as $link): ?>
                <?php
                $href = (string) ($link['href'] ?? '#');
                if (str_starts_with($href, 'route:')) {
                    $routeKey = substr($href, 6);
                    $href = $routeUrls[$routeKey] ?? '#';
                }
                ?>
                <a href="<?= e($href); ?>"><?= e($link['label']); ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</footer>
