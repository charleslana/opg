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

    /**
     * @throws CustomException
     */
    public function findCharacterById(int $id): bool|object
    {
        $parameters = [':id' => $id];
        $database = new Database();
        $result = $database->select("SELECT * FROM `character` WHERE id = :id", $parameters);
        if (count($result) != 1) {
            return false;
        }
        return $result[0];
    }
}