<?php
if (!class_exists('core\classes\Functions')) {
    die();
}

use core\classes\Functions;
use core\enum\ItemTypeEnum;
use core\service\AccountItemService;

$nextPage = true;
$page = !isset($_GET['page']) ? 1 : Functions::setAbsoluteValue($_GET['page']);
$unequippedItems = AccountItemService::showUnequippedItem($page);
$equippedItems = AccountItemService::showEquippedItem();
if (!$unequippedItems) {
    $nextPage = false;
}
$data = array('title' => 'Inventário');
include('components/title.php');
?>
<div class="row g-3">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header d-flex flex-between-center bg-light py-2">
                <h6 class="mb-0">Itens equipados</h6>
                <div class="dropdown font-sans-serif btn-reveal-trigger">
                    <button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal"
                            type="button" id="dropdown-active-user" data-bs-toggle="dropdown" data-boundary="viewport"
                            aria-haspopup="true" aria-expanded="false">
                        <svg class="svg-inline--fa fa-ellipsis-h fa-w-16 fs--2" aria-hidden="true" focusable="false"
                             data-prefix="fas" data-icon="ellipsis-h" role="img" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 512 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                  d="M328 256c0 39.8-32.2 72-72 72s-72-32.2-72-72 32.2-72 72-72 72 32.2 72 72zm104-72c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72zm-352 0c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72z"></path>
                        </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-active-user">
                        <a class="dropdown-item" href="#">Equipar automaticamente</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="#">Desequipar tudo</a>
                    </div>
                </div>
            </div>
            <div class="card-body py-2">
                <?php
                $helmet = array('title' => 'Item de capacete');
                $weapon = array('title' => 'Item de arma');
                $clothing = array('title' => 'Item de vestimenta');
                $shoe = array('title' => 'Item de calçado');
                $accessory = array('title' => 'Item de acessório');
                foreach ($equippedItems as $equippedItem) {
                    match ($equippedItem->getItem()->getType()) {
                        ItemTypeEnum::Helmet => $helmet = array('title' => 'Item de capacete', 'name' => $equippedItem->getItem()->getName(), 'image' => $equippedItem->getItem()->getImage()),
                        ItemTypeEnum::Weapon => $weapon = array('title' => 'Item de arma', 'name' => $equippedItem->getItem()->getName(), 'image' => $equippedItem->getItem()->getImage()),
                        ItemTypeEnum::Clothing => $clothing = array('title' => 'Item de vestimenta', 'name' => $equippedItem->getItem()->getName(), 'image' => $equippedItem->getItem()->getImage()),
                        ItemTypeEnum::Shoe => $shoe = array('title' => 'Item de calçado', 'name' => $equippedItem->getItem()->getName(), 'image' => $equippedItem->getItem()->getImage()),
                        ItemTypeEnum::Accessory => $helmet = array('title' => 'Item de acessório', 'name' => $equippedItem->getItem()->getName(), 'image' => $equippedItem->getItem()->getImage())
                    };
                }
                $data = $helmet;
                include('components/inventory/equipped_item.php');
                $data = $weapon;
                include('components/inventory/equipped_item.php');
                $data = $clothing;
                include('components/inventory/equipped_item.php');
                $data = $shoe;
                include('components/inventory/equipped_item.php');
                $data = $accessory;
                include('components/inventory/equipped_item.php');
                ?>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header">
                <div class="row justify-content-between gx-0">
                    <div class="col-auto">
                        <h1 class="fs-0 text-900">Itens no inventário</h1>
                    </div>
                    <div class="col-auto">
                        <select class="form-select form-select-sm pe-4" id="select-gross-revenue-month">
                            <option value="0">Item de equipar</option>
                            <option value="1">Item de usar</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0 pb-3 h-100">
                <?php if ($nextPage) : ?>
                    <div class="row row-cols-auto">
                        <?php foreach ($unequippedItems as $unequippedItem) : ?>
                            <div class="col text-start separate-column">
                                <div class="item border rounded-3 bg-danger"
                                     style="background-image: url('../../public/assets/img/items/<?= $unequippedItem->getItem()->getImage() ?>.png')"></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-danger text-center mb-3 w-100" role="alert">
                        Nenhum item no inventário.
                    </div>
                <?php endif; ?>
            </div>
            <div class="card-footer bg-light py-2">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?action=inventory&page=<?= $page - 1 ?>"
                                   aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Anterior</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="page-item active">
                            <span class="page-link"><?= $page ?></span>
                        </li>
                        <?php if ($nextPage) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?action=inventory&page=<?= $page + 1 ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Próximo</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>