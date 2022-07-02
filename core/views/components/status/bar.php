<?php
if (!isset($data)) {
    die();
}
extract($data);
?>
<div class="col-md-6 col-xxl-8">
    <div class="card h-100">
        <div class="card-header d-flex flex-between-center border-bottom border-200">
            <h6 class="mb-0 d-flex">
                <span class="fs-0 ra <?= $data['icon'] ?> me-1 text-<?= $data['color'] ?>"></span>
                <?= $data['title'] ?>
            </h6>
        </div>
        <div class="card-body d-flex align-items-center">
            <div class="w-100">
                <h3 class="text-700 mb-6">+<?= $data['attribute'] ?></h3>
                <div class="progress overflow-visible rounded-3 font-sans-serif fw-medium fs--1 mt-xxl-auto"
                     style="height: 20px;">
                    <div class="progress-bar overflow-visible bg-<?= $data['color'] ?> border-end border-white border-2 rounded-pill text-start"
                         role="progressbar" style="width: <?= $data['percentage'] ?>%" aria-valuenow="0"
                         aria-valuemin="0" aria-valuemax="100">
                        <div class="text-700 mt-n6 row">
                            <div class="col-6"><?= $data['minValue'] ?></div>
                            <div class="col-6 text-end"><?= $data['maxValue'] ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
