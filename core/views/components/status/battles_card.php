<?php
if (!isset($data)) {
    die();
}
extract($data);
?>
<div class="col-6 col-md-3 border-200 border-bottom pb-4">
    <h6 class="pb-1 text-700"><?= $data['name'] ?></h6>
    <p class="font-sans-serif lh-1 mb-1 fs-2"><?= $data['value'] ?></p>
    <div class="d-flex align-items-center">
        <h6 class="fs--1 text-500 mb-0"><?= $data['abbreviatedValue'] ?></h6>
    </div>
</div>
