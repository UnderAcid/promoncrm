<?php
/** @var App\Localization\Translator $t */
?>
<footer class="footer">
    <div class="container footer-inner">
        <div><?= e($t->get('footer.copyright', ['year' => date('Y')])); ?></div>
        <div class="footer-links">
            <?php foreach ($t->get('footer.links') as $link): ?>
                <?php
                $href = (string) ($link['href'] ?? '#');
                $label = (string) ($link['label'] ?? $href);
                $copyAttributes = '';
                if (str_starts_with($href, 'mailto:')) {
                    $contactValue = substr($href, strlen('mailto:'));
                    $copyAttributes = ' data-copy-value="' . e($contactValue) . '" data-contact-type="email"';
                }
                ?>
                <a href="<?= e($href); ?>"<?= $copyAttributes; ?>><?= e($label); ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</footer>
