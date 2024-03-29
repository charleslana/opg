<?php
if (!class_exists('core\classes\Functions')) {
    die();
}

use core\classes\Functions;
use core\service\CharacterService;

$nextPage = true;
$page = !isset($_GET['page']) ? 1 : Functions::setAbsoluteValue($_GET['page']);
$characters = CharacterService::showAllCharacter($page);
if (!$characters) {
    $nextPage = false;
}

$data = array(
    'image' => 1,
    'title' => 'Olá, seja bem vindo(a)',
    'description' => 'Aqui você recrutar novos tripulantes',
    'infoText' => 'Lembre-se, para desbloquear personagens é necessário alguns requisitos conforme cada personagem.'
);
include('components/helper.php');
?>
<?php if ($nextPage) : ?>
    <div class="card mb-3">
        <div class="card-header">
            <div class="row row-cols-auto mb-3">
                <?php foreach ($characters as &$character) : ?>
                    <div class="col text-start separate-column">
                        <div class="character-portrait" onclick="showCharacterDetails(<?= $character->getId() ?>)"
                             style="background-image: url('/public/assets/img/characters/portrait/<?= $character->getImage() ?>.png')"></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-danger text-center mb-3" role="alert">Nenhum personagem encontrado</div>
<?php endif; ?>
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <?php if ($page > 1) : ?>
            <li class="page-item">
                <a class="page-link" href="?action=recruit_crew&page=<?= $page - 1 ?>" aria-label="Previous">
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
                <a class="page-link" href="?action=recruit_crew&page=<?= $page + 1 ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Próximo</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
<div class="offcanvas offcanvas-end" id="offcanvasRight" tabindex="-1" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Luffy</h5>
        <button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <img id="characterImage" src="../../public/assets/img/characters/landscape/1.png" alt="" height="200"
             class="center mb-3">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="status-tab" data-bs-toggle="tab" href="#tab-status"
                   role="tab" aria-controls="tab-home" aria-selected="true">Status
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="requirements-tab" data-bs-toggle="tab" href="#tab-requirements"
                   role="tab" aria-controls="tab-profile" aria-selected="false">Requisitos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="recruit-tab" data-bs-toggle="tab" href="#tab-recruit"
                   role="tab" aria-controls="tab-contact" aria-selected="false">Recrutar
                </a>
            </li>
        </ul>
        <div class="tab-content p-3" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-status" role="tabpanel" aria-labelledby="status-tab">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Atributos de força por nível
                        <span class="badge badge-soft-primary rounded-pill" id="strengthAttributes">+3</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Atributos de defesa por nível
                        <span class="badge badge-soft-primary rounded-pill" id="defenseAttributes">+1</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Atributos de vida por nível
                        <span class="badge badge-soft-primary rounded-pill" id="lifeAttributes">+1</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Atributos de energia por nível
                        <span class="badge badge-soft-primary rounded-pill" id="energyAttributes">+1</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Atributos de agilidade por nível
                        <span class="badge badge-soft-primary rounded-pill" id="agilityAttributes">+1</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Atributos de resistência por nível
                        <span class="badge badge-soft-primary rounded-pill" id="resistanceAttributes">+1</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Atributos de inteligência por nível
                        <span class="badge badge-soft-primary rounded-pill" id="intelligenceAttributes">+1</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Nível máximo
                        <span class="badge badge-soft-primary rounded-pill" id="maximumLevel">60</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Desbloqueio de Haki
                        <span class="badge badge-soft-primary rounded-pill" id="hakiUnlock">não</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Desbloqueio de Akuma no mi
                        <span class="badge badge-soft-primary rounded-pill" id="akumaNoMiUnlock">sim</span>
                    </li>
                </ul>
                <div class="alert alert-warning border-2 d-flex align-items-center mt-3" role="alert">
                    <div class="bg-warning me-3 icon-item">
                        <span class="fas fa-exclamation-circle text-white fs-3"></span>
                    </div>
                    <p class="mb-0 flex-1">
                        Você poderá evoluir o nível de um tripulante usando seus tripulantes de maior nível
                    </p>
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <div class="tab-pane fade row" id="tab-requirements" role="tabpanel" aria-labelledby="requirements-tab">
                <div class="col-12">
                    <p class="fs-0">Nível de jogador</p>
                    <div class="progress mb-3 position-relative" style="height:15px">
                        <div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="25"
                             aria-valuemin="0" aria-valuemax="100" id="playerLevelUnlock">
                            <span class="justify-content-center d-flex position-absolute w-100 text-1000">0/0</span>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <p class="fs-0">Algum personagem de nível</p>
                    <div class="progress mb-3 position-relative" style="height:15px">
                        <div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="25"
                             aria-valuemin="0" aria-valuemax="100" id="characterLevelUnlock">
                            <span class="justify-content-center d-flex position-absolute w-100 text-1000">0/0</span>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <p class="fs-0">Algum personagem com batalhas NPC</p>
                    <div class="progress mb-3 position-relative" style="height:15px">
                        <div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="25"
                             aria-valuemin="0" aria-valuemax="100" id="characterNpcBattlesUnlock">
                            <span class="justify-content-center d-flex position-absolute w-100 text-1000">0/0</span>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <p class="fs-0">Algum personagem com batalhas Arena</p>
                    <div class="progress mb-3 position-relative" style="height:15px">
                        <div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="25"
                             aria-valuemin="0" aria-valuemax="100" id="characterArenaBattlesUnlock">
                            <span class="justify-content-center d-flex position-absolute w-100 text-1000">0/0</span>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <p class="fs-0">Algum personagem com vitórias NPC</p>
                    <div class="progress mb-3 position-relative" style="height:15px">
                        <div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="25"
                             aria-valuemin="0" aria-valuemax="100" id="characterNpcWinsUnlock">
                            <span class="justify-content-center d-flex position-absolute w-100 text-1000">0/0</span>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <p class="fs-0">Algum personagem com vitórias Arena</p>
                    <div class="progress mb-3 position-relative" style="height:15px">
                        <div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="25"
                             aria-valuemin="0" aria-valuemax="100" id="characterArenaWinsUnlock">
                            <span class="justify-content-center d-flex position-absolute w-100 text-1000">0/0</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-recruit" role="tabpanel" aria-labelledby="recruit-tab">
                <button class="btn btn-primary me-1 mb-1" type="button" id="free-recruit" onclick="recruitCrewFree()">
                    Recrutar gratuito
                </button>
                <hr>
                <div class="alert alert-warning" role="alert" id="alert">
                    Você pode pagar com <span class="gold-icon"></span> para recrutar agora!
                </div>
                <button class="btn btn-outline-warning me-1 mb-1" type="button" id="goldUnlock" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="0 Ouro" onclick="recruitPaidCrew()">
                    Recrutar 1K <span class="gold-icon"></span>
                </button>
            </div>
        </div>
    </div>
</div>