<?php
if (!isset($data)) {
    die();
}
extract($data);
?>
<div class="card mb-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">
                    <?= $data['title'] ?>
                </h5>
            </div>
        </div>
    </div>
</div>