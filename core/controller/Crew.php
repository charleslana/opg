<?php

namespace core\controller;

use core\classes\Functions;

class Crew
{

    public function recruitCrew(): void
    {
        Functions::validateLoggedAccount();
        Functions::showGameLayout('recruit_crew', false);
    }

    public function selectCrew(): void
    {
        Functions::validateLoggedAccount();
        Functions::showGameLayout('select_crew');
    }
}