<?php
if (!isset($data)) {
    die();
}
extract($data);
?>
<div class="d-flex align-items-center position-relative mb-3">
    <div class="avatar avatar-2xl">
        <?php if (isset($data['image'])) : ?>
            <img class="rounded-circle border bg-primary" src="../../../../public/assets/img/items/<?= $data['image'] ?>.png" alt="">
        <?php else: ?>
            <img class="rounded-circle" src="../../../../public/assets/img/icons/plus.png" alt="">
        <?php endif; ?>
    </div>
    <div class="flex-1 ms-3">
        <h6 class="mb-0 fw-semi-bold">
            <a class="stretched-link text-900" href="#"><?= $data['title'] ?></a>
        </h6>
        <p class="text-500 fs--2 mb-0"><?= $data['name'] ?? '' ?></p>
    </div>
</div>
