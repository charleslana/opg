<?php

namespace core\repository;

use core\classes\Database;
use core\exception\CustomException;
use core\service\AccountService;

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
    public function findCharacterByIdAndAccountCharacterIdAndAccountId(int $id): bool|object
    {
        $parameters = [':id' => $id, ':accountId' => AccountService::getAccountId()];
        $database = new Database();
        $result = $database->select('
            SELECT c.*, ac.*, a.level AS accountLevel FROM `character` c
                LEFT OUTER JOIN (SELECT * FROM account_character ORDER BY level DESC, npc_battles DESC, arena_battles DESC, npc_wins DESC, arena_wins DESC LIMIT 1) ac ON (c.id = ac.character_id)
                    LEFT OUTER JOIN account a ON (a.id = :accountId)
                        WHERE c.id = :id
            ', $parameters
        );
        if (count($result) != 1) {
            return false;
        }
        return $result[0];
    }
}