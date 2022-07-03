<?php

namespace core\controller;

use core\classes\Functions;

class Inventory
{

    public function inventory(): void
    {
        Functions::validateLoggedAccountCharacter();
        Functions::showGameLayout('inventory');
    }
}