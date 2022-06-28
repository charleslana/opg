<?php

namespace core\service;

use core\classes\Functions;
use core\classes\Messages;
use core\enum\PaidEnum;
use core\enum\ResponseEnum;
use core\exception\CustomException;
use core\repository\CharacterRepository;

class CharacterService
{

    /**
     * @throws CustomException
     */
    public static function addCharacter(int $id, PaidEnum $paid): void
    {
        if (!Functions::validateLoggedUser()) {
            Functions::handleResponse(Messages::$accountNotLogged);
        }
        $characterRepository = new CharacterRepository();
        self::validateCharacterRequirements($characterRepository, $id, $paid);
        $characterRepository->saveCharacter($id);
        Functions::handleResponse(Messages::$characterAddedSuccessfully, ResponseEnum::Success);
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
        $characterRepository = new CharacterRepository();
        return $characterRepository->findAllByCharacterWithPagination($page, $total);
    }

    /**
     * @throws CustomException
     */
    public static function showCharacter(int $id): object
    {
        if (!Functions::validateLoggedUser()) {
            Functions::handleResponse(Messages::$accountNotLogged);
        }
        $characterRepository = new CharacterRepository();
        $result = $characterRepository->findCharacterByIdAndAccountCharacterByIdAndAccountById($id);
        if (!$result) {
            Functions::handleResponse(Messages::$characterNotFound);
        }
        return $result;
    }

    /**
     * @throws CustomException
     */
    private static function payCrew(PaidEnum $paid, object|bool $result): void
    {
        if ($paid == PaidEnum::Paid) {
            if ($result->accountGold < $result->gold_unlock) {
                Functions::handleResponse(Messages::$insufficientGold);
            }
            AccountService::updateGold($result->accountGold - $result->gold_unlock);
        }
    }

    /**
     * @throws CustomException
     */
    private static function validateCharacterRequirements(CharacterRepository $characterRepository, int $id, PaidEnum $paid): void
    {
        $result = $characterRepository->findCharacterByIdAndAccountCharacterByIdAndAccountById($id);
        if (!$result) {
            Functions::handleResponse(Messages::$characterNotFound);
        }
        if ($paid == PaidEnum::Free && (AccountService::getAccount()->level < $result->player_level_unlock || $result->level < $result->character_level_unlock || $result->npc_battles < $result->character_npc_battles_unlock || $result->arena_battles < $result->character_arena_battles_unlock || $result->npc_wins < $result->character_npc_wins_unlock || $result->arena_wins < $result->character_arena_wins_unlock)) {
            Functions::handleResponse(Messages::$necessaryRequirements);
        }
        $existCharacterId = preg_grep("/$id/", explode(',', $result->accountCharacterIds));
        if ($existCharacterId) {
            Functions::handleResponse(Messages::$characterAlreadyAdded);
        }
        self::payCrew($paid, $result);
    }
}