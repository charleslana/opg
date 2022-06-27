<?php
if (!isset($character)) {
    die();
}

use core\classes\Functions;
use core\service\StatusService;

extract(get_object_vars($character));
$data = array('title' => 'Status do personagem');
include('components/title.php');
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
                <div class="tab-content border-x border-bottom p-3" id="myTabContent">
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
                                title="<?= Functions::numberFormat(StatusService::calculateDamage($character->strength_attributes, $character->level)) ?>">
                                Dano
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberAbbreviation(StatusService::calculateDamage($character->strength_attributes, $character->level)) ?>
                                </span>
                            </li>
                            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                title="<?= Functions::numberFormat(StatusService::calculateShield($character->defense_attributes, $character->level)) ?>">
                                Escudo
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberAbbreviation(StatusService::calculateShield($character->defense_attributes, $character->level)) ?>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                title="<?= Functions::numberFormat(StatusService::calculateLife($character->life_attributes, $character->level)) ?>">
                                Vida
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberAbbreviation(StatusService::calculateLife($character->life_attributes, $character->level)) ?>
                                </span>
                            </li>
                            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                title="<?= Functions::numberFormat(StatusService::calculateEnergy($character->energy_attributes, $character->level)) ?>">
                                Energia
                                <span class="badge badge-soft-primary rounded-pill">
                                    <?= Functions::numberAbbreviation(StatusService::calculateEnergy($character->energy_attributes, $character->level)) ?>
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
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center">
                        Batalhas NPC
                        <span class="badge badge-soft-primary rounded-pill">
                            <?= Functions::numberFormat($character->npc_battles) ?>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Batalhas Arena
                        <span class="badge badge-soft-primary rounded-pill">
                            <?= Functions::numberFormat($character->arena_battles) ?>
                        </span>
                    </li>
                    <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center">
                        Vitórias NPC
                        <span class="badge badge-soft-primary rounded-pill">
                            <?= Functions::numberFormat($character->npc_wins) ?>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Derrotas NPC
                        <span class="badge badge-soft-primary rounded-pill">
                            <?= Functions::numberFormat($character->npc_defeats) ?>
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
                </ul>
            </div>
        </div>
    </div>
</div>
