<?php

namespace core\service;

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
}