<?php

namespace core\service;

use core\classes\Functions;
use core\classes\Messages;
use core\exception\CustomException;
use core\model\dto\ItemAccountItemDTO;
use core\repository\AccountItemRepository;

class AccountItemService
{

    /**
     * @return ItemAccountItemDTO[]
     * @throws CustomException
     */
    public static function showAllItem(int $actualPage): array
    {
        if (!Functions::validateLoggedCrew()) {
            Functions::handleResponse(Messages::$characterNotLogged);
        }
        $total = 20;
        $page = $actualPage - 1;
        $page = $page * $total;
        if ($page < 0) {
            $page = 0;
        }
        $repository = new AccountItemRepository();
        return $repository->findAllByAccountItemAndItemWithPagination(AccountCharacterService::getCharacterId(), $page, $total);
    }
}