<?php

namespace core\repository;

use core\classes\Database;
use core\exception\CustomException;

class AccountCharacterRepository
{

    /**
     * @throws CustomException
     */
    public function findAllByAccountCharacterAndCharacterWithPagination(int $accountId, int $page, int $size): array|bool
    {
        $parameters = [':accountId' => $accountId];
        $database = new Database();
        return $database->select("
            SELECT ac.*, c.image, c.name FROM account_character ac
                LEFT OUTER JOIN `character` c ON (c.id = ac.character_id)
                    WHERE ac.account_id = :accountId ORDER BY ac.level DESC, ac.id LIMIT $page,$size
            ", $parameters
        );
    }

    /**
     * @throws CustomException
     */
    public function findByCharacter(int $id, int $accountId): bool|object
    {
        $parameters = [':id' => $id, ':accountId' => $accountId];
        $database = new Database();
        $result = $database->select('
            SELECT ac.*, ac.id AS accountCharacterId, c.* FROM account_character ac
                LEFT OUTER JOIN `character` c ON (c.id = ac.character_id)
                    WHERE ac.id = :id AND ac.account_id = :accountId
            ', $parameters);
        if (count($result) != 1) {
            return false;
        }
        return $result[0];
    }
}