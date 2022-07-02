<?php
if (!isset($data)) {
    die();
}
extract($data);
?>
<div class="col-md-12 border border-1 border-300 rounded-2 p-3 ask-analytics-item position-relative mb-3">
    <div class="d-flex align-items-center mb-3">
        <span class="fs-0 ra <?= $data['icon'] ?> text-primary"></span>
        <div class="stretched-link text-decoration-none">
            <h5 class="fs--1 text-600 mb-0 ps-3"><?= $data['title'] ?></h5>
        </div>
    </div>
    <h5 class="fs--1 text-800"><?= $data['description'] ?></h5>
</div>
