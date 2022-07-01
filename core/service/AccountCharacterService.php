<?php

namespace core\service;

use core\classes\Functions;
use core\classes\Messages;
use core\enum\SessionEnum;
use core\exception\CustomException;
use core\model\dto\CharacterAccountCharacterDTO;
use core\repository\AccountCharacterRepository;

class AccountCharacterService
{

    public static function characterLogout(): void
    {
        if (isset($_SESSION[SessionEnum::AccountCharacterId->value])) {
            unset($_SESSION[SessionEnum::AccountCharacterId->value]);
        }
    }

    /**
     * @throws CustomException
     */
    public static function getCharacter(): CharacterAccountCharacterDTO
    {
        $accountCharacterRepository = new AccountCharacterRepository();
        return $accountCharacterRepository->findByCharacter(self::getCharacterId(), AccountService::getAccountId());
    }

    public static function getCharacterId(): int
    {
        return $_SESSION[SessionEnum::AccountCharacterId->value];
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
        $_SESSION[SessionEnum::AccountCharacterId->value] = $result->getAccountCharacter()->getId();
    }

    /**
     * @return CharacterAccountCharacterDTO[]
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