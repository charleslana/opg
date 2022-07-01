<?php
if (!defined('APP_TAG_NAME')) {
    die();
}

use core\service\AccountCharacterService;

$character = AccountCharacterService::getCharacter();
?>
<nav class="navbar navbar-light navbar-vertical navbar-expand-xl" aria-label="">
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">
            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip"
                    data-bs-placement="left" title="Toggle Navigation">
                        <span class="navbar-toggle-icon">
                            <span class="toggle-line"></span></span>
            </button>
        </div>
        <a class="navbar-brand" href="">
            <div class="d-flex align-items-center py-3">
                <span class="font-sans-serif"><?= APP_TAG_NAME ?></span>
            </div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <span class="d-block d-sm-none"><?php include('status_bar.php') ?></span>
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label"><?= $character->getCharacter()->getName() ?></div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider"/>
                        </div>
                    </div>
                    <a class="nav-link" href="?action=status" role="button" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center">
                                    <span class="nav-link-icon">
                                        <span class="ra ra-player"></span>
                                    </span>
                            <span class="nav-link-text ps-1">Status</span>
                        </div>
                    </a>
                    <a class="nav-link" href="#" role="button" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center">
                                    <span class="nav-link-icon">
                                        <span class="fas fa-comments"></span>
                                    </span>
                            <span class="nav-link-text ps-1">Menu</span>
                        </div>
                    </a>
                    <a class="nav-link dropdown-indicator" href="#menu" role="button"
                       data-bs-toggle="collapse" aria-expanded="false"
                       aria-controls="email">
                        <div class="d-flex align-items-center">
                                    <span class="nav-link-icon">
                                        <span class="fas fa-envelope-open"></span>
                                    </span>
                            <span class="nav-link-text ps-1">Menu</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="menu">
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="" aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Submenu</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="" aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Submenu</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Menu 2</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider"/>
                        </div>
                    </div>
                    <a class="nav-link" href="#" role="button" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center">
                                    <span class="nav-link-icon">
                                        <span class="fas fa-calendar-alt"></span>
                                    </span>
                            <span class="nav-link-text ps-1">Menu 2</span>
                        </div>
                    </a>
                    <a class="nav-link" href="#" role="button" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center">
                                    <span class="nav-link-icon">
                                        <span class="fas fa-comments"></span>
                                    </span>
                            <span class="nav-link-text ps-1">Menu 2</span>
                        </div>
                    </a>
                    <a class="nav-link dropdown-indicator" href="#menu2" role="button"
                       data-bs-toggle="collapse" aria-expanded="false"
                       aria-controls="email">
                        <div class="d-flex align-items-center">
                                    <span class="nav-link-icon">
                                        <span class="fas fa-envelope-open"></span>
                                    </span>
                            <span class="nav-link-text ps-1">Menu 2</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="menu2">
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="" aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Submenu 2</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="" aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Submenu 2</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>