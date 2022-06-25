<?php include('navbar.php') ?>
<li class="nav-item dropdown px-1">
    <a class="nav-link fa-icon-wait nine-dots p-1" id="navbarDropdownMenu" role="button"
       data-hide-on-body-scroll="data-hide-on-body-scroll" data-bs-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false">
        <em class="ra ra-vest fs-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Inventário"></em>
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
                                             src="../../../public/assets/img/characters/portrait/1.png"
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