<?php
if (!isset($character)) {
    die();
}

use core\classes\Functions;
use core\service\StatusService;

extract(get_object_vars($character));
$data = array('title' => 'Status do personagem');
include('components/title.php');
$damage = StatusService::calculateDamage($character->getCharacter()->getStrengthAttributes(), $character->getAccountCharacter()->getLevel());
$shield = StatusService::calculateShield($character->getCharacter()->getDefenseAttributes(), $character->getAccountCharacter()->getLevel());
$calculateLife = StatusService::calculateLife($character->getCharacter()->getLifeAttributes(), $character->getAccountCharacter()->getLevel());
$calculatePercentageOfLife = StatusService::calculatePercentageOfValue($character->getAccountCharacter()->getLife(), $calculateLife);
$calculateEnergy = StatusService::calculateEnergy($character->getCharacter()->getEnergyAttributes(), $character->getAccountCharacter()->getLevel());
$calculatePercentageOfEnergy = StatusService::calculatePercentageOfValue($character->getAccountCharacter()->getEnergy(), $calculateEnergy);
?>
<div class="card mb-3">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-md-6 mb-3">
                <img src="../../public/assets/img/characters/landscape/<?= $character->getCharacter()->getImage() ?>.png"
                     alt=""
                     class="center mb-3 img-fluid" height="200"/>
                <span class="badge bg-secondary w-100"><?= $character->getCharacter()->getName() ?></span>
            </div>
            <div class="col-md-6">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="attribute-tab" data-bs-toggle="tab" href="#tab-attribute"
                           role="tab" aria-controls="tab-home" aria-selected="true">
                            Atributos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="power-tab" data-bs-toggle="tab" href="#tab-power"
                           role="tab" aria-controls="tab-profile" aria-selected="false">Poder
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="detail-tab" data-bs-toggle="tab" href="#tab-detail"
                           role="tab" aria-controls="tab-detail" aria-selected="false">Detalhes
                        </a>
                    </li>
                </ul>
                <div class="tab-content border-x border-bottom p-3" id="attribute">
                    <div class="tab-pane fade show active" id="tab-attribute" role="tabpanel"
                         aria-labelledby="attribute-tab">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center">
                                Nível
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat($character->getAccountCharacter()->getLevel()) ?>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Força
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat(StatusService::calculateAttribute($character->getCharacter()->getStrengthAttributes(), $character->getAccountCharacter()->getLevel())) ?>
                                </span>
                            </li>
                            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center">
                                Defesa
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat(StatusService::calculateAttribute($character->getCharacter()->getDefenseAttributes(), $character->getAccountCharacter()->getLevel())) ?>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Vida
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat(StatusService::calculateAttribute($character->getCharacter()->getLifeAttributes(), $character->getAccountCharacter()->getLevel())) ?>
                                </span>
                            </li>
                            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center">
                                Energia
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat(StatusService::calculateAttribute($character->getCharacter()->getEnergyAttributes(), $character->getAccountCharacter()->getLevel())) ?>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Agilidade
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat(StatusService::calculateAttribute($character->getCharacter()->getAgilityAttributes(), $character->getAccountCharacter()->getLevel())) ?>
                                </span>
                            </li>
                            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center">
                                Resistência
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat(StatusService::calculateAttribute($character->getCharacter()->getResistanceAttributes(), $character->getAccountCharacter()->getLevel())) ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="tab-power" role="tabpanel" aria-labelledby="power-tab">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                title="<?= Functions::numberFormat($damage) ?>">
                                Dano
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberAbbreviation($damage) ?>
                                </span>
                            </li>
                            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                title="<?= Functions::numberFormat($shield) ?>">
                                Escudo
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberAbbreviation($shield) ?>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Crítico
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= StatusService::calculateCritical($character->getCharacter()->getAgilityAttributes(), $character->getAccountCharacter()->getLevel()) ?>%
                                </span>
                            </li>
                            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center">
                                Esquiva
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= StatusService::calculateDodge($character->getCharacter()->getResistanceAttributes(), $character->getAccountCharacter()->getLevel()) ?>%
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Vida
                                <div class="progress position-relative" style="height:20px; width: 75%"
                                     data-bs-toggle="tooltip" data-bs-placement="top"
                                     title="<?= Functions::numberFormat($calculatePercentageOfLife) ?>/<?= Functions::numberFormat($calculateLife) ?>">
                                    <div class="progress-bar bg-danger progress-bar-striped"
                                         role="progressbar"
                                         style="width: <?= $character->getAccountCharacter()->getLife() ?>%"
                                         aria-valuenow="0"
                                         aria-valuemin="0"
                                         aria-valuemax="100">
                                        <span class="justify-content-center d-flex position-absolute w-100 text-1000 fw-bold">
                                            <?= Functions::numberAbbreviation($calculatePercentageOfLife) ?>/<?= Functions::numberAbbreviation($calculateLife) ?>
                                        </span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center">
                                Energia
                                <div class="progress position-relative" style="height:20px; width: 75%"
                                     data-bs-toggle="tooltip" data-bs-placement="top"
                                     title="<?= Functions::numberFormat($calculatePercentageOfEnergy) ?>/<?= Functions::numberFormat($calculateEnergy) ?>">
                                    <div class="progress-bar bg-primary progress-bar-striped"
                                         role="progressbar"
                                         style="width: <?= $character->getAccountCharacter()->getEnergy() ?>%"
                                         aria-valuenow="0"
                                         aria-valuemin="0"
                                         aria-valuemax="100">
                                        <span class="justify-content-center d-flex position-absolute w-100 text-1000 fw-bold">
                                            <?= Functions::numberAbbreviation($calculatePercentageOfEnergy) ?>/<?= Functions::numberAbbreviation($calculateEnergy) ?>
                                        </span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="tab-detail" role="tabpanel"
                         aria-labelledby="attribute-tab">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center">
                                Raça
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= $character->getCharacter()->getBreed()->getName() ?>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Classe
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= $character->getCharacter()->getClass()->getName() ?>
                                </span>
                            </li>
                            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center">
                                Organização
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= $character->getCharacter()->getOrganization()->getName() ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="npc-tab" data-bs-toggle="tab" href="#tab-npc" role="tab"
                           aria-controls="tab-npc" aria-selected="true">
                            NPC
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="arena-tab" data-bs-toggle="tab" href="#tab-arena" role="tab"
                           aria-controls="tab-arena" aria-selected="false">
                            Arena
                        </a>
                    </li>
                </ul>
                <div class="tab-content border-x border-bottom p-3" id="battles">
                    <div class="tab-pane fade show active" id="tab-npc" role="tabpanel" aria-labelledby="npc-tab">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center">
                                Batalhas NPC
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat($character->getAccountCharacter()->getNpcBattles()) ?>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Vitórias NPC
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat($character->getAccountCharacter()->getNpcWins()) ?>
                                </span>
                            </li>
                            <li class="list-group-item list-group-item-secondary  d-flex justify-content-between align-items-center">
                                Derrotas NPC
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat($character->getAccountCharacter()->getNpcDefeats()) ?>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Empates NPC
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat($character->getAccountCharacter()->getNpcDraws()) ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="tab-arena" role="tabpanel" aria-labelledby="arena-tab">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Batalhas Arena
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat($character->getAccountCharacter()->getArenaBattles()) ?>
                                </span>
                            </li>
                            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center">
                                Vitórias Arena
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat($character->getAccountCharacter()->getArenaWins()) ?>
                             </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Derrotas Arena
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat($character->getAccountCharacter()->getArenaDefeats()) ?>
                                </span>
                            </li>
                            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center">
                                Empates Arena
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat($character->getAccountCharacter()->getArenaDraws()) ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
