<?php
if (!isset($data)) {
    die();
}
extract($data);
?>
<div class="row g-0 align-items-center py-2 position-relative border-bottom border-200" data-bs-toggle="tooltip"
     data-bs-placement="top" title="<?= $data['tooltip'] ?>">
    <div class="col ps-card py-1 position-static">
        <div class="d-flex align-items-center">
            <div class="avatar avatar-xl me-3">
                <div class="avatar-name rounded-circle bg-soft-<?= $data['color'] ?> text-dark">
                    <span class="fs-0 text-<?= $data['color'] ?> ra <?= $data['icon'] ?>"></span>
                </div>
            </div>
            <div class="flex-1">
                <h6 class="mb-0 d-flex align-items-center">
                    <span class="text-800 stretched-link"><?= $data['name'] ?></span>
                    <span class="badge rounded-pill ms-2 bg-200 text-primary"><?= $data['value'] ?></span>
                </h6>
            </div>
        </div>
    </div>
    <div class="col py-1">
        <div class="row flex-end-center g-0">
            <div class="col-auto pe-2">
                <div class="fs--1 fw-semi-bold"><?= $data['attribute'] ?></div>
            </div>
            <div class="col-5 pe-card ps-2">
                <div class="progress bg-200 me-2" style="height: 5px;">
                    <div class="progress-bar rounded-pill" role="progressbar" style="width: 38%"
                         aria-valuenow="38" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
</div>
