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
$strength = Functions::numberFormat(StatusService::calculateAttribute($character->getCharacter()->getStrengthAttributes(), $character->getAccountCharacter()->getLevel()));
$defense = Functions::numberFormat(StatusService::calculateAttribute($character->getCharacter()->getDefenseAttributes(), $character->getAccountCharacter()->getLevel()));
$agility = Functions::numberFormat(StatusService::calculateAttribute($character->getCharacter()->getAgilityAttributes(), $character->getAccountCharacter()->getLevel()));
$resistance = Functions::numberFormat(StatusService::calculateAttribute($character->getCharacter()->getResistanceAttributes(), $character->getAccountCharacter()->getLevel()));
$intelligence = Functions::numberFormat(StatusService::calculateAttribute($character->getCharacter()->getIntelligenceAttributes(), $character->getAccountCharacter()->getLevel()));
$critical = StatusService::calculateCritical($character->getCharacter()->getIntelligenceAttributes(), $character->getAccountCharacter()->getLevel());
$dodge = StatusService::calculateDodge($character->getCharacter()->getAgilityAttributes(), $character->getAccountCharacter()->getLevel());
$blocking = StatusService::calculateBlocking($character->getCharacter()->getResistanceAttributes(), $character->getAccountCharacter()->getLevel());
$life = Functions::numberFormat(StatusService::calculateAttribute($character->getCharacter()->getLifeAttributes(), $character->getAccountCharacter()->getLevel()));
$energy = Functions::numberFormat(StatusService::calculateAttribute($character->getCharacter()->getEnergyAttributes(), $character->getAccountCharacter()->getLevel()));
?>
<div class="row g-3">
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header d-flex flex-between-center bg-light py-2">
                <h6 class="mb-0"><?= $character->getCharacter()->getName() ?></h6>
                <div class="font-sans-serif btn-reveal-trigger">
                    Nível <?= Functions::numberFormat($character->getAccountCharacter()->getLevel()) ?>
                </div>
            </div>
            <div class="card-body py-2">
                <img src="../../public/assets/img/characters/landscape/<?= $character->getCharacter()->getImage() ?>.png"
                     alt=""
                     class="center mb-3 img-fluid" height="200"/>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card h-lg-100 overflow-hidden">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="mb-0">Atributos</h6>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <?php
                $data = array('separator' => true, 'tooltip' => 'Dano', 'icon' => 'ra-muscle-up', 'color' => 'primary', 'name' => 'Força', 'value' => '+' . Functions::numberAbbreviation($damage), 'attribute' => $strength, 'percentage' => StatusService::calculateBar($strength, $defense, $intelligence, $agility, $resistance));
                include('components/status/attributes.php');
                $data = array('separator' => true, 'tooltip' => 'Escudo', 'icon' => 'ra-shield', 'color' => 'success', 'name' => 'Defesa', 'value' => '+' . Functions::numberAbbreviation($shield), 'attribute' => $defense, 'percentage' => StatusService::calculateBar($defense, $strength, $intelligence, $agility, $resistance));
                include('components/status/attributes.php');
                $data = array('separator' => true, 'tooltip' => 'Crítico', 'icon' => 'ra-player-pain', 'color' => 'info', 'name' => 'Inteligência', 'value' => "$critical%", 'attribute' => $intelligence, 'percentage' => StatusService::calculateBar($intelligence, $defense, $strength, $agility, $resistance));
                include('components/status/attributes.php');
                $data = array('separator' => true, 'tooltip' => 'Esquiva', 'icon' => 'ra-player-dodge', 'color' => 'warning', 'name' => 'Agilidade', 'value' => "$dodge%", 'attribute' => $agility, 'percentage' => StatusService::calculateBar($agility, $defense, $intelligence, $strength, $resistance));
                include('components/status/attributes.php');
                $data = array('tooltip' => 'Bloqueio', 'icon' => 'ra-player-thunder-struck', 'color' => 'danger', 'name' => 'Resistência', 'value' => "$blocking%", 'attribute' => $resistance, 'percentage' => StatusService::calculateBar($resistance, $defense, $intelligence, $agility, $strength));
                include('components/status/attributes.php');
                ?>
            </div>
        </div>
    </div>
    <?php
    $data = array('title' => 'Vida', 'icon' => 'ra-hearts', 'color' => 'danger', 'attribute' => $life, 'minValue' => Functions::numberAbbreviation($calculatePercentageOfLife), 'maxValue' => Functions::numberAbbreviation($calculateLife), 'percentage' => $character->getAccountCharacter()->getLife());
    include('components/status/bar.php');
    $data = array('title' => 'Energia', 'icon' => 'ra-aura', 'color' => 'info', 'attribute' => $energy, 'minValue' => Functions::numberAbbreviation($calculatePercentageOfEnergy), 'maxValue' => Functions::numberAbbreviation($calculateEnergy), 'percentage' => $character->getAccountCharacter()->getEnergy());
    include('components/status/bar.php');
    ?>
    <div class="col-md-12 col-xxl-4">
        <div class="card h-100">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h5 class="fs-0 fw-normal text-800 mb-0">Detalhes</h5>
                </div>
            </div>
            <div class="card-body">
                <?php
                $data = array('title' => 'Raça', 'description' => $character->getCharacter()->getBreed()->getName(), 'icon' => 'ra-fluffy-swirl');
                include('components/status/details_card.php');
                $data = array('title' => 'Classe', 'description' => $character->getCharacter()->getClass()->getName(), 'icon' => 'ra-hive-emblem');
                include('components/status/details_card.php');
                $data = array('title' => 'Organização', 'description' => $character->getCharacter()->getOrganization()->getName(), 'icon' => 'ra-double-team');
                include('components/status/details_card.php');
                ?>
            </div>
        </div>
    </div>
    <div class="col-xxl-6 col-xl-12">
        <div class="card py-3 mb-3">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h5 class="fs-0 fw-normal text-800 mb-0">NPC</h5>
                </div>
            </div>
            <div class="card-body py-3">
                <div class="row g-0">
                    <?php
                    $data = array('name' => 'Batalhas', 'value' => Functions::numberFormat($character->getAccountCharacter()->getNpcBattles()), 'abbreviatedValue' => Functions::numberAbbreviation($character->getAccountCharacter()->getNpcBattles()));
                    include('components/status/battles_card.php');
                    $data = array('name' => 'Vitórias', 'value' => Functions::numberFormat($character->getAccountCharacter()->getNpcWins()), 'abbreviatedValue' => Functions::numberAbbreviation($character->getAccountCharacter()->getNpcWins()));
                    include('components/status/battles_card.php');
                    $data = array('name' => 'Derrotas', 'value' => Functions::numberFormat($character->getAccountCharacter()->getNpcDefeats()), 'abbreviatedValue' => Functions::numberAbbreviation($character->getAccountCharacter()->getNpcDefeats()));
                    include('components/status/battles_card.php');
                    $data = array('name' => 'Empates', 'value' => Functions::numberFormat($character->getAccountCharacter()->getNpcDraws()), 'abbreviatedValue' => Functions::numberAbbreviation($character->getAccountCharacter()->getNpcDraws()));
                    include('components/status/battles_card.php');
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-6 col-xl-12">
        <div class="card py-3 mb-3">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h5 class="fs-0 fw-normal text-800 mb-0">Arena</h5>
                </div>
            </div>
            <div class="card-body py-3">
                <div class="row g-0">
                    <?php
                    $data = array('name' => 'Batalhas', 'value' => Functions::numberFormat($character->getAccountCharacter()->getArenaBattles()), 'abbreviatedValue' => Functions::numberAbbreviation($character->getAccountCharacter()->getArenaBattles()));
                    include('components/status/battles_card.php');
                    $data = array('name' => 'Vitórias', 'value' => Functions::numberFormat($character->getAccountCharacter()->getArenaWins()), 'abbreviatedValue' => Functions::numberAbbreviation($character->getAccountCharacter()->getArenaWins()));
                    include('components/status/battles_card.php');
                    $data = array('name' => 'Derrotas', 'value' => Functions::numberFormat($character->getAccountCharacter()->getArenaDefeats()), 'abbreviatedValue' => Functions::numberAbbreviation($character->getAccountCharacter()->getArenaDefeats()));
                    include('components/status/battles_card.php');
                    $data = array('name' => 'Empates', 'value' => Functions::numberFormat($character->getAccountCharacter()->getArenaDraws()), 'abbreviatedValue' => Functions::numberAbbreviation($character->getAccountCharacter()->getArenaDraws()));
                    include('components/status/battles_card.php');
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
