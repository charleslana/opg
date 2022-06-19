<?php

namespace core\service;

use core\classes\Functions;
use core\classes\Messages;
use core\exception\CustomException;
use core\repository\CharacterRepository;

class CharacterService
{

    /**
     * @throws CustomException
     */
    public static function showAllCharacter(int $actualPage): array
    {
        $total = 20;
        $page = $actualPage - 1;
        $page = $page * $total;
        if ($page < 0) {
            $page = 0;
        }
        $characterRepository = new CharacterRepository();
        return $characterRepository->findAllByCharacterWithPagination($page, $total);
    }

    /**
     * @throws CustomException
     */
    public static function showCharacter(int $id): object
    {
        if (!Functions::validateLoggedUser()) {
            Functions::handleErrors(Messages::$accountNotLogged);
        }
        $characterRepository = new CharacterRepository();
        $result = $characterRepository->findCharacterByIdAndAccountCharacterByIdAndAccountById($id);
        if (!$result) {
            Functions::handleErrors(Messages::$characterNotFound);
        }
        return $result;
    }
}