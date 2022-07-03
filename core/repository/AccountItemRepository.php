<?php

namespace core\repository;

use core\classes\Database;
use core\enum\YesNoEnum;
use core\exception\CustomException;
use core\model\dto\ItemAccountItemDTO;

class AccountItemRepository extends AbstractRepository
{

    /**
     * @return ItemAccountItemDTO[]
     * @throws CustomException
     */
    public function findAllByAccountItemAndItemWithPagination(int $accountCharacterId, int $page, int $size, YesNoEnum $isEquipped): array
    {
        $parameters = [':accountCharacterId' => $accountCharacterId, ':isEquipped' => $isEquipped->value];
        $database = new Database();
        $results = $database->select("
            SELECT ai.*, i.*, ai.id AS accountItemId, ai.linked AS accountItemLinked, cl.id AS classId, cl.name AS className FROM account_item ai
                LEFT OUTER JOIN item i ON (i.id = ai.item_id)
                LEFT OUTER JOIN class cl ON (cl.id = i.class_id)                                                                                                             
                    WHERE ai.account_character_id = :accountCharacterId AND ai.equipped = :isEquipped ORDER BY ai.level DESC, ai.id LIMIT $page,$size
            ", $parameters
        );
        return $this->setFindAllByAccountItemAndItemWithPagination($results);
    }

    /**
     * @return ItemAccountItemDTO[]
     */
    private function setFindAllByAccountItemAndItemWithPagination(array $results): array
    {
        $array = [];
        foreach ($results as $result) {
            $dto = new ItemAccountItemDTO();
            $dto->setAccountItem($this->getAccountItemAbstract($result));
            $dto->setItem($this->getItemAbstract($result));
            $array[] = $dto;
        }
        return $array;
    }
}