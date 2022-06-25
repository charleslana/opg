<?php
if (!defined('APP_TAG_NAME')) {
    die();
}
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
        <span class="d-none d-sm-block"><?php include('status_bar.php') ?></span>
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