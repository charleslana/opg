<?php

namespace core\controller;

use core\classes\Functions;

class Crew
{

    public function createCrew(): void
    {
        Functions::validateLoggedAccount();
        Functions::showGameLayout('create_crew', false);
    }

    public function selectCrew(): void
    {
        Functions::validateLoggedAccount();
        Functions::showGameLayout('select_crew', false);
    }
}