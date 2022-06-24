<?php

namespace core\service;

use core\classes\Functions;
use core\classes\Messages;
use core\exception\CustomException;
use core\repository\AccountCharacterRepository;

class AccountCharacterService
{

    public static function characterLogout(): void
    {
        if (isset($_SESSION['characterId'])) {
            unset($_SESSION['characterId']);
        }
    }

    public static function getCharacterId(): int
    {
        return $_SESSION['characterId'];
    }

    /**
     * @throws CustomException
     */
    public static function selectCharacter(int $id): void
    {
        if (!Functions::validateLoggedUser()) {
            Functions::handleResponse(Messages::$accountNotLogged);
        }
        $accountCharacterRepository = new AccountCharacterRepository();
        $result = $accountCharacterRepository->findByCharacter($id, AccountService::getAccountId());
        if (!$result) {
            Functions::handleResponse(Messages::$characterNotFound);
        }
        $_SESSION['characterId'] = $result->id;
    }

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
        $accountCharacterRepository = new AccountCharacterRepository();
        return $accountCharacterRepository->findAllByAccountCharacterAndCharacterWithPagination(AccountService::getAccountId(), $page, $total);
    }
}