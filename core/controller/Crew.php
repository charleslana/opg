<?php

namespace core\controller;

use core\classes\Functions;
use core\enum\PaidEnum;
use core\exception\CustomException;
use core\service\CharacterService;

class Crew
{

    /**
     * @throws CustomException
     */
    public function getCharacterDetails(): void
    {
        Functions::validateGetRequest();
        $id = 0;
        if (isset($_GET['id'])) {
            $id = Functions::setAbsoluteValue($_GET['id']);
        }
        $result = CharacterService::showCharacter($id);
        echo json_encode($result);
    }

    public function recruitCrew(): void
    {
        Functions::validateLoggedAccount();
        Functions::showGameLayout('recruit_crew', false);
    }

    /**
     * @throws CustomException
     */
    public function addCrew(): void
    {
        Functions::validatePostRequest();
        $id = 0;
        if (isset($_GET['id'])) {
            $id = Functions::setAbsoluteValue($_GET['id']);
        }
        $paid = PaidEnum::Free;
        if (isset($_GET['isPaid'])) {
            $paid = PaidEnum::Paid;
        }
        CharacterService::addCharacter($id, $paid);
    }

    public function selectCrew(): void
    {
        Functions::validateLoggedAccount();
        Functions::showGameLayout('select_crew', false);
    }
}