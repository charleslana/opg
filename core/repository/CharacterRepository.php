<?php

namespace core\repository;

use core\classes\Database;
use core\exception\CustomException;

class CharacterRepository
{

    /**
     * @throws CustomException
     */
    public function findAllByCharacterWithPagination(int $page, int $size): array|bool
    {
        $database = new Database();
        return $database->select("SELECT id, image FROM `character` LIMIT $page,$size");
    }
}