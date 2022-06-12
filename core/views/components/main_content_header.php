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
                <span class="font-sans-serif">OPG</span>
            </div>
        </a>
        <ul class="navbar-nav align-items-center d-none d-lg-block">
            <li class="nav-item d-none d-sm-block">
                <a class="nav-link px-0 notification-indicator notification-indicator-warning notification-indicator-fill fa-icon-wait"
                   href="#">
                            <span class="fas fa-shopping-cart" data-fa-transform="shrink-7"
                                  style="font-size: 33px;"></span>
                    <span class="notification-indicator-number">1</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
            <li class="nav-item">
                <div class="theme-control-toggle fa-icon-wait px-2">
                    <input class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle"
                           type="checkbox" data-theme-control="theme" value="dark"/>
                    <label class="mb-0 theme-control-toggle-label theme-control-toggle-light"
                           for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                           title="Switch to light theme">
                        <span class="fas fa-sun fs-0"></span>
                    </label>
                    <label class="mb-0 theme-control-toggle-label theme-control-toggle-dark"
                           for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                           title="Switch to dark theme">
                        <span class="fas fa-moon fs-0"></span>
                    </label>
                </div>
            </li>
            <li class="nav-item d-none d-sm-block">
                <a class="nav-link px-0 notification-indicator notification-indicator-primary px-0 fa-icon-wait"
                   href="#">
                            <span class="fas fa-bell" data-fa-transform="shrink-6"
                                  style="font-size: 33px;"></span>
                    <span class="notification-indicator-number"></span>
                </a>
            </li>
            <li class="nav-item dropdown px-1">
                <a class="nav-link fa-icon-wait nine-dots p-1" id="navbarDropdownMenu" role="button"
                   data-hide-on-body-scroll="data-hide-on-body-scroll" data-bs-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="43" viewBox="0 0 16 16"
                         fill="none">
                        <circle cx="2" cy="2" r="2" fill="#6C6E71"></circle>
                        <circle cx="2" cy="8" r="2" fill="#6C6E71"></circle>
                        <circle cx="2" cy="14" r="2" fill="#6C6E71"></circle>
                        <circle cx="8" cy="8" r="2" fill="#6C6E71"></circle>
                        <circle cx="8" cy="14" r="2" fill="#6C6E71"></circle>
                        <circle cx="14" cy="8" r="2" fill="#6C6E71"></circle>
                        <circle cx="14" cy="14" r="2" fill="#6C6E71"></circle>
                        <circle cx="8" cy="2" r="2" fill="#6C6E71"></circle>
                        <circle cx="14" cy="2" r="2" fill="#6C6E71"></circle>
                    </svg>
                </a>
                <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end dropdown-menu-card dropdown-caret-bg"
                     aria-labelledby="navbarDropdownMenu">
                    <div class="card shadow-none">
                        <div class="scrollbar-overlay nine-dots-dropdown">
                            <div class="card-body px-3">
                                <div class="row text-center gx-0 gy-0">
                                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                                        <div class="col-4">
                                            <a class="d-block hover-bg-200 px-2 py-3 rounded-3 text-center text-decoration-none"
                                               href="#" target="_blank">
                                                <div class="avatar avatar-2xl">
                                                    <img class="rounded-circle"
                                                         src="../../../public/assets/img/characters/1/portrait/1.png"
                                                         alt=""/>
                                                </div>
                                                <p class="mb-0 fw-medium text-800 text-truncate fs--2">
                                                    Character</p>
                                            </a>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-xl">
                        <img class="rounded-circle" src="../../../public/assets/img/characters/1/portrait/1.png"
                             alt=""/>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0"
                     aria-labelledby="navbarDropdownUser">
                    <div class="bg-white dark__bg-1000 rounded-2 py-2">
                        <a class="dropdown-item fw-bold text-warning" href="#">
                            <span class="fas fa-crown me-1"></span><span>Obtenha VIP</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Menu</a>
                        <a class="dropdown-item" href="#">Menu</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Menu</a>
                        <a class="dropdown-item" href="?action=index">Deslogar</a>
                    </div>
                </div>
            </li>
        </ul>
    </nav>