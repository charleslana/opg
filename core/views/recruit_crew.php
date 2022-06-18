<?php

use core\service\CharacterService;

$nextPage = true;
$page = !isset($_GET['page']) ? 1 : $_GET['page'];
$characters = CharacterService::showAllCharacter($page);
if (!$characters) {
    $nextPage = false;
}
?>
<div class="card mb-3">
    <div class="card-body overflow-hidden p-lg-3">
        <div class="row align-items-center">
            <div class="col-md-3 text-center"><img src="/public/assets/img/helper/1.png" alt="" height="200"></div>
            <div class="col-md-9 ps-lg-4 my-5 text-center text-lg-start">
                <h3 class="text-primary">Olá, seja bem vindo(a)</h3>
                <p class="lead">Aqui você recrutar novos tripulantes</p>
                <div class="alert alert-info border-2 d-flex align-items-center" role="alert">
                    <div class="bg-info me-3 icon-item"><span class="fas fa-info-circle text-white fs-3"></span></div>
                    <p class="mb-0 flex-1">Lembre-se, para desbloquear personagens é necessário alguns requisitos
                        conforme cada personagem.</p>
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if ($nextPage) : ?>
    <div class="row row-cols-auto mb-3">
        <?php foreach ($characters as $key => $character) : ?>
            <div class="col text-start">
                <div class="character-portrait <?php if ($key == 0) {
                    echo 'blocked';
                } ?>" onclick="showCharacterDetails()"
                     style="background-image: url('/public/assets/img/characters/portrait/<?= $character->image ?>.png')"></div>
            </div>
        <?php endforeach; ?>
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
                    <span class="sr-only">Previous</span>
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
                    <span class="sr-only">Next</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
<div class="offcanvas offcanvas-end" id="offcanvasRight" tabindex="-1" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel" class="placeholder-glow"><span class="placeholder">Luffy</span></h5>
        <button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <img src="../../public/assets/img/characters/landscape/1.png" alt="" height="200" class="center mb-3">
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
                        <span class="badge badge-soft-primary rounded-pill">+3</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Atributos de defesa por nível
                        <span class="badge badge-soft-primary rounded-pill">+1</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Atributos de vida por nível
                        <span class="badge badge-soft-primary rounded-pill">+1</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Atributos de energia por nível
                        <span class="badge badge-soft-primary rounded-pill">+1</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Atributos de agilidade por nível
                        <span class="badge badge-soft-primary rounded-pill">+1</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Atributos de resistência por nível
                        <span class="badge badge-soft-primary rounded-pill">+1</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Nível máximo
                        <span class="badge badge-soft-primary rounded-pill">60</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Desbloqueio de Haki
                        <span class="badge badge-soft-primary rounded-pill">não</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Desbloqueio de Akuma no mi
                        <span class="badge badge-soft-primary rounded-pill">sim</span>
                    </li>
                </ul>
            </div>
            <div class="tab-pane fade row" id="tab-requirements" role="tabpanel" aria-labelledby="requirements-tab">
                <div class="col-12">
                    <p class="fs-0">Nível de jogador</p>
                    <div class="progress mb-3" style="height:15px">
                        <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="25"
                             aria-valuemin="0" aria-valuemax="100">
                            0/0
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <p class="fs-0">Algum personagem de nível</p>
                    <div class="progress mb-3" style="height:15px">
                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="25"
                             aria-valuemin="0" aria-valuemax="100">
                            0/0
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <p class="fs-0">Algum personagem com batalhas NPC</p>
                    <div class="progress mb-3" style="height:15px">
                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="25"
                             aria-valuemin="0" aria-valuemax="100">
                            0/0
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <p class="fs-0">Algum personagem com batalhas Arena</p>
                    <div class="progress mb-3" style="height:15px">
                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="25"
                             aria-valuemin="0" aria-valuemax="100">
                            0/0
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <p class="fs-0">Algum personagem com vitórias NPC</p>
                    <div class="progress mb-3" style="height:15px">
                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="25"
                             aria-valuemin="0" aria-valuemax="100">
                            0/0
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <p class="fs-0">Algum personagem com vitórias Arena</p>
                    <div class="progress mb-3" style="height:15px">
                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="25"
                             aria-valuemin="0" aria-valuemax="100">
                            0/0
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-recruit" role="tabpanel" aria-labelledby="recruit-tab">
                <button class="btn btn-primary me-1 mb-1" type="button">Recrutar gratuito</button>
                <hr>
                <div class="alert alert-warning" role="alert">
                    Você pode pagar com <span class="gold-icon"></span> para recrutar agora!
                </div>
                <button class="btn btn-outline-warning me-1 mb-1" type="button">
                    Recrutar 1K <span class="gold-icon"></span>
                </button>
            </div>
        </div>
    </div>
</div>