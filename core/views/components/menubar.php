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
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label"><?= $_SESSION['name'] ?></div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider"/>
                        </div>
                    </div>
                    <a class="nav-link" href="?action=select_crew" role="button" data-bs-toggle=""
                       aria-expanded="false">
                        <div class="d-flex align-items-center">
                                    <span class="nav-link-icon">
                                        <span class="ra ra-player"></span>
                                    </span>
                            <span class="nav-link-text ps-1">Selecionar tripulação</span>
                        </div>
                    </a>
                    <a class="nav-link" href="?action=recruit_crew" role="button" data-bs-toggle=""
                       aria-expanded="false">
                        <div class="d-flex align-items-center">
                                    <span class="nav-link-icon">
                                        <span class="ra ra-double-team"></span>
                                    </span>
                            <span class="nav-link-text ps-1">Recrutar tripulação</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>