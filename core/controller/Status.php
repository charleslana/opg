<?php

namespace core\controller;

use core\classes\Functions;

class Status
{

    public function status(): void
    {
        Functions::validateLoggedAccountCharacter();
        Functions::showGameLayout('status');
    }
}