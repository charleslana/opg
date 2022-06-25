<?php
if (!defined('APP_NAME')) {
    die();
}
?>
<footer class="footer">
    <div class="row g-0 justify-content-between fs--1 mt-4 mb-3">
        <div class="col-12 col-sm-auto text-center">
            <p class="mb-0 text-600">Obrigado por jogar <?= APP_NAME ?>
                <span class="d-none d-sm-inline-block">| </span>
                <br class="d-sm-none"/> <?= date('Y') ?>&copy;
                <a href="#"><?= APP_AUTHOR ?></a>
            </p>
        </div>
        <div class="col-12 col-sm-auto text-center">
            <p class="mb-0 text-600">v<?= APP_VERSION ?></p>
        </div>
    </div>
</footer>
</div>