<?php
if (!isset($account)) {
    die();
}
extract(get_object_vars($account));
?>
<li class="nav-item dropdown">
    <a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false">
        <div class="avatar avatar-xl">
            <img class="rounded-circle" src="../../../public/assets/img/characters/portrait/<?= $account->avatar ?>.png"
                 alt=""/>
        </div>
    </a>