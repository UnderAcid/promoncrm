<?php
/** @var App\Localization\Translator $t */
?>
<footer class="footer">
    <div class="container footer-inner">
        <div><?= e($t->get('footer.copyright', ['year' => date('Y')])); ?></div>
        <div class="footer-links">
            <?php foreach ($t->get('footer.links') as $link): ?>
                <?php $isContactLink = isset($link['href']) && str_starts_with((string) $link['href'], 'mailto:'); ?>
                <a href="<?= e($link['href']); ?>"<?= $isContactLink ? ' data-track-contact="email"' : ''; ?>><?= e($link['label']); ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</footer>
