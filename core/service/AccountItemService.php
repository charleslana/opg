<?php

namespace core\service;

use core\enum\YesNoEnum;
use core\exception\CustomException;
use core\model\dto\ItemAccountItemDTO;
use core\repository\AccountItemRepository;

class AccountItemService
{

    /**
     * @return ItemAccountItemDTO[]
     * @throws CustomException
     */
    public static function showEquippedItem(): array
    {
        $repository = new AccountItemRepository();
        return $repository->findAllByAccountItemAndItemWithPagination(AccountCharacterService::getCharacterId(), 0, 5, YesNoEnum::Yes);
    }

    /**
     * @return ItemAccountItemDTO[]
     * @throws CustomException
     */
    public static function showUnequippedItem(int $actualPage): array
    {
        $total = 20;
        $page = $actualPage - 1;
        $page = $page * $total;
        if ($page < 0) {
            $page = 0;
        }
        $repository = new AccountItemRepository();
        return $repository->findAllByAccountItemAndItemWithPagination(AccountCharacterService::getCharacterId(), $page, $total, YesNoEnum::No);
    }
}