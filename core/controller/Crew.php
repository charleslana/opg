<?php

namespace core\controller;

use core\classes\Functions;

class Crew
{

    public function createCrew(): void
    {
        Functions::showGameLayout('create_crew', false);
    }
}