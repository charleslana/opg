<?php
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
                $data = array('title' => 'Item de cabeça', 'name' => 'Kabuto', 'image' => 3);
                include('components/inventory/equipped_item.php');
                $data = array('title' => 'Item de mão');
                include('components/inventory/equipped_item.php');
                $data = array('title' => 'Item de corpo');
                include('components/inventory/equipped_item.php');
                $data = array('title' => 'Item de bota');
                include('components/inventory/equipped_item.php');
                $data = array('title' => 'Item de acessório');
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
                <div class="row">
                    <div class="col text-start separate-column">
                        <div class="item border rounded-3 bg-danger" style="background-image: url('../../public/assets/img/items/1.png')"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
