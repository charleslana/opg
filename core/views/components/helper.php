<?php
if (!isset($data)) {
    die();
}
extract($data);
?>
<div class="card mb-3">
    <div class="card-body overflow-hidden p-lg-3">
        <div class="row align-items-center">
            <div class="col-md-3 text-center">
                <img src="/public/assets/img/helper/<?= $data['image'] ?>.png" alt="" height="200"/>
            </div>
            <div class="col-md-9 ps-lg-4 my-5 text-center text-lg-start">
                <h3 class="text-primary"><?= $data['title'] ?></h3>
                <p class="lead"><?= $data['description'] ?></p>
                <?php if (isset($data['infoText'])) : ?>
                    <div class="alert alert-info border-2 d-flex align-items-center" role="alert">
                        <div class="bg-info me-3 icon-item">
                            <span class="fas fa-info-circle text-white fs-3"></span>
                        </div>
                        <p class="mb-0 flex-1"><?= $data['infoText'] ?></p>
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>