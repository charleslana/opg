<?php
if (!class_exists('core\classes\Functions')) {
    die();
}

use core\classes\Functions;
use core\service\AccountService;

$account = AccountService::getAccount();
$maximumExperience = AccountService::calculateExperience($account->level);
$percentageExperience = Functions::calculatePercentage($account->experience, $maximumExperience);
?>
<ul class="navbar-nav align-items-center">
    <li class="nav-item me-3">
        <div class="nav-link px-0" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true"
             title="Berries<br><?= Functions::numberFormat($account->belly) ?>">
            <span class="belly-icon"></span> <?= Functions::numberAbbreviation($account->belly) ?>
        </div>
    </li>
    <li class="nav-item me-3">
        <a class="nav-link px-0" href="#" data-bs-toggle="tooltip" data-bs-placement="bottom"
           data-bs-html="true" title="Ouro<br><?= Functions::numberFormat($account->gold) ?>">
            <span class="gold-icon"></span> <?= Functions::numberAbbreviation($account->gold) ?>
            <button class="btn btn-outline-primary btn-sm rounded-pill me-1 mb-1" type="button">
                <em class="fas fa-plus fs--2"></em>
            </button>
        </a>
    </li>
    <li class="nav-item">
        <span class="badge rounded-pill bg-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nível">
            <?= $account->level ?>
        </span>
        <em class="ra ra-flask align-middle" data-bs-toggle="tooltip" data-bs-placement="bottom"
            title="Experiência"></em>
    </li>
    <li class="nav-item me-3">
        <div class="progress position-relative" style="height:20px; width: 100px;"
             data-bs-toggle="tooltip" data-bs-placement="bottom"
             title="<?= Functions::numberFormat($account->experience) ?>/<?= Functions::numberFormat($maximumExperience) ?>">
            <div class="progress-bar bg-success" role="progressbar" style="width: <?= $percentageExperience ?>%"
                 aria-valuenow="0"
                 aria-valuemin="0"
                 aria-valuemax="100">
                <span class="justify-content-center d-flex position-absolute w-100 text-1000"><?= $percentageExperience ?>%</span>
            </div>
        </div>
    </li>
</ul>