<?php
if (!isset($character)) {
    die();
}

use core\classes\Functions;
use core\service\StatusService;

extract(get_object_vars($character));
$data = array('title' => 'Status do personagem');
include('components/title.php');
$damage = StatusService::calculateDamage($character->strength_attributes, $character->level);
$shield = StatusService::calculateShield($character->defense_attributes, $character->level);
$calculateLife = StatusService::calculateLife($character->life_attributes, $character->level);
$calculatePercentageOfLife = StatusService::calculatePercentageOfValue($character->life, $calculateLife);
$calculateEnergy = StatusService::calculateEnergy($character->energy_attributes, $character->level);
$calculatePercentageOfEnergy = StatusService::calculatePercentageOfValue($character->energy, $calculateEnergy);
?>
<div class="card mb-3">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-md-6 mb-3">
                <img src="../../public/assets/img/characters/landscape/<?= $character->image ?>.png" alt=""
                     class="center mb-3 img-fluid" height="200"/>
                <span class="badge bg-secondary w-100"><?= $character->name ?></span>
            </div>
            <div class="col-md-6">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="attribute-tab" data-bs-toggle="tab" href="#tab-attribute"
                           role="tab" aria-controls="tab-home" aria-selected="true">
                            Atributos
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" id="power-tab" data-bs-toggle="tab" href="#tab-power"
                                            role="tab" aria-controls="tab-profile" aria-selected="false">Poder</a></li>
                </ul>
                <div class="tab-content border-x border-bottom p-3" id="attribute">
                    <div class="tab-pane fade show active" id="tab-attribute" role="tabpanel"
                         aria-labelledby="attribute-tab">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center">
                                Nível
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat($character->level) ?>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Força
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat(StatusService::calculateAttribute($character->strength_attributes, $character->level)) ?>
                                </span>
                            </li>
                            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center">
                                Defesa
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat(StatusService::calculateAttribute($character->defense_attributes, $character->level)) ?>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Vida
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat(StatusService::calculateAttribute($character->life_attributes, $character->level)) ?>
                                </span>
                            </li>
                            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center">
                                Energia
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat(StatusService::calculateAttribute($character->energy_attributes, $character->level)) ?>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Agilidade
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat(StatusService::calculateAttribute($character->agility_attributes, $character->level)) ?>
                                </span>
                            </li>
                            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center">
                                Resistência
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat(StatusService::calculateAttribute($character->resistance_attributes, $character->level)) ?>
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
                                    <?= StatusService::calculateCritical($character->agility_attributes, $character->level) ?>%
                                </span>
                            </li>
                            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center">
                                Esquiva
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= StatusService::calculateDodge($character->resistance_attributes, $character->level) ?>%
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Vida
                                <div class="progress position-relative" style="height:20px; width: 75%"
                                     data-bs-toggle="tooltip" data-bs-placement="bottom"
                                     title="<?= Functions::numberFormat($calculatePercentageOfLife) ?>/<?= Functions::numberFormat($calculateLife) ?>">
                                    <div class="progress-bar bg-danger progress-bar-striped"
                                         role="progressbar" style="width: <?= $character->life ?>%"
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
                                     data-bs-toggle="tooltip" data-bs-placement="bottom"
                                     title="<?= Functions::numberFormat($calculatePercentageOfEnergy) ?>/<?= Functions::numberFormat($calculateEnergy) ?>">
                                    <div class="progress-bar bg-primary progress-bar-striped"
                                         role="progressbar" style="width: <?= $character->energy ?>%"
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
                                    <?= Functions::numberFormat($character->npc_battles) ?>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Vitórias NPC
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat($character->npc_wins) ?>
                                </span>
                            </li>
                            <li class="list-group-item list-group-item-secondary  d-flex justify-content-between align-items-center">
                                Derrotas NPC
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat($character->npc_defeats) ?>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Empates NPC
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat($character->npc_draws) ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="tab-arena" role="tabpanel" aria-labelledby="arena-tab">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Batalhas Arena
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat($character->arena_battles) ?>
                                </span>
                            </li>
                            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center">
                                Vitórias Arena
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat($character->arena_wins) ?>
                             </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Derrotas Arena
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat($character->arena_defeats) ?>
                                </span>
                            </li>
                            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center">
                                Empates Arena
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberFormat($character->arena_draws) ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
