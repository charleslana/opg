<?php

namespace core\controller;

use core\classes\Functions;
use core\enum\PaymentEnum;
use core\exception\CustomException;
use core\service\AccountCharacterService;
use core\service\CharacterService;

class Crew
{

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
        $payment = PaymentEnum::Free;
        if (isset($_GET['isPaid'])) {
            $payment = PaymentEnum::Pay;
        }
        CharacterService::addCharacter($id, $payment);
    }

    /**
     * @throws CustomException
     */
    public function createCrewSession(): void
    {
        Functions::validatePostRequest();
        $id = 0;
        if (isset($_GET['id'])) {
            $id = Functions::setAbsoluteValue($_GET['id']);
        }
        AccountCharacterService::selectCharacter($id);
    }

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
        echo $result->toJSON();
    }

    public function recruitCrew(): void
    {
        Functions::validateLoggedAccount();
        AccountCharacterService::characterLogout();
        Functions::showGameLayout('recruit_crew', false);
    }

    public function selectCrew(): void
    {
        Functions::validateLoggedAccount();
        AccountCharacterService::characterLogout();
        Functions::showGameLayout('select_crew', false);
    }
}