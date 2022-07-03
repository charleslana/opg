<?php

namespace core\controller;

use core\classes\Functions;
use core\exception\CustomException;
use core\service\AccountItemService;

class Inventory
{

    public function inventory(): void
    {
        Functions::validateLoggedAccountCharacter();
        Functions::showGameLayout('inventory');
    }

    /**
     * @throws CustomException
     */
    public function allItem(): void
    {
        Functions::validateGetRequest();
        $page = 0;
        if (isset($_GET['page'])) {
            $page = Functions::setAbsoluteValue($_GET['page']);
        }
        $results = AccountItemService::showAllItem($page);
        $array = [];
        foreach ($results as $result) {
            $array[] = json_decode($result->toJSON());
        }
        echo json_encode($array);
    }
}