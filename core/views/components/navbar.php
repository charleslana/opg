<?php
if (!class_exists('core\classes\Functions')) {
    die();
}

use core\classes\Functions;
use core\service\AccountService;

$account = AccountService::getAccount();

?>
<div class="content">
    <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand" aria-label="">
        <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
                aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation">
                    <span class="navbar-toggle-icon">
                        <span class="toggle-line"></span>
                    </span>
        </button>
        <a class="navbar-brand me-1 me-sm-3" href="#">
            <div class="d-flex align-items-center">
                <span class="font-sans-serif"><?= APP_TAG_NAME ?></span>
            </div>
        </a>
        <ul class="navbar-nav align-items-center">
            <li class="nav-item d-none d-sm-block me-3">
                <div class="nav-link px-0" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true"
                     title="Berries<br><?= Functions::numberFormat($account->belly) ?>">
                    <span class="belly-icon"></span> <?= Functions::numberAbbreviation($account->belly) ?>
                </div>
            </li>
            <li class="nav-item d-none d-sm-block me-3">
                <a class="nav-link px-0" href="#" data-bs-toggle="tooltip" data-bs-placement="bottom"
                   data-bs-html="true" title="Ouro<br><?= Functions::numberFormat($account->gold) ?>">
                    <span class="gold-icon"></span> <?= Functions::numberAbbreviation($account->gold) ?>
                    <button class="btn btn-outline-primary btn-sm rounded-pill me-1 mb-1" type="button">
                        <em class="fas fa-plus fs--2"></em>
                    </button>
                </a>
            </li>
            <li class="nav-item d-none d-sm-block">
                <span class="badge rounded-pill bg-primary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                      title="Nível">
                    1
                </span>
                <em class="ra ra-flask align-middle" data-bs-toggle="tooltip" data-bs-placement="bottom"
                    title="Experiência"></em>
            </li>
            <li class="nav-item d-none d-sm-block me-3">
                <div class="progress position-relative" style="height:20px; width: 100px;"
                     data-bs-toggle="tooltip" data-bs-placement="bottom" title="25/100">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 50%"
                         aria-valuenow="25"
                         aria-valuemin="0"
                         aria-valuemax="100">
                        <span class="justify-content-center d-flex position-absolute w-100 text-1000">50%</span>
                    </div>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
            <li class="nav-item">
                <div class="theme-control-toggle fa-icon-wait px-2">
                    <input class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle"
                           type="checkbox" data-theme-control="theme" value="dark"/>
                    <label class="mb-0 theme-control-toggle-label theme-control-toggle-light"
                           for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                           title="Alternar para o tema claro">
                        <span class="fas fa-sun fs-0"></span>
                    </label>
                    <label class="mb-0 theme-control-toggle-label theme-control-toggle-dark"
                           for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                           title="Alternar para o tema escuro">
                        <span class="fas fa-moon fs-0"></span>
                    </label>
                </div>
            </li>