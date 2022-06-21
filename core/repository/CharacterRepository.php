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
    public function findCharacterByIdAndAccountCharacterByIdAndAccountById(int $id): bool|object
    {
        $parameters = [':id' => $id, ':accountId' => AccountService::getAccountId()];
        $database = new Database();
        $result = $database->select('
            SELECT c.*, ac.*, a.level AS accountLevel, gold AS accountGold, ac2.accountCharacterIds FROM `character` c
                LEFT OUTER JOIN (SELECT MAX(level) AS level, MAX(npc_battles) AS npc_battles, MAX(arena_battles) AS arena_battles, MAX(npc_wins) AS npc_wins, MAX(arena_wins) AS arena_wins
                                 FROM account_character WHERE account_id = :accountId LIMIT 1) ac ON (c.id = c.id)
                LEFT OUTER JOIN (SELECT GROUP_CONCAT(character_id) AS accountCharacterIds FROM account_character WHERE account_id = :accountId) ac2 ON (c.id = c.id)
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