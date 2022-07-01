<?php

namespace core\service;

use core\classes\Functions;
use core\classes\Messages;
use core\enum\PaymentEnum;
use core\enum\ResponseEnum;
use core\exception\CustomException;
use core\model\CharacterModel;
use core\model\dto\CharacterAccountCharacterAccountDTO;
use core\repository\CharacterRepository;

class CharacterService
{

    /**
     * @throws CustomException
     */
    public static function addCharacter(int $id, PaymentEnum $payment): void
    {
        if (!Functions::validateLoggedUser()) {
            Functions::handleResponse(Messages::$accountNotLogged);
        }
        $characterRepository = new CharacterRepository();
        self::validateCharacterRequirements($characterRepository, $id, $payment);
        $characterRepository->saveCharacter($id);
        Functions::handleResponse(Messages::$characterAddedSuccessfully, ResponseEnum::Success);
    }

    /**
     * @return CharacterModel[]
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
    public static function showCharacter(int $id): CharacterAccountCharacterAccountDTO
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
    private static function payCrew(PaymentEnum $payment, ?CharacterAccountCharacterAccountDTO $result): void
    {
        if ($payment == PaymentEnum::Pay) {
            if ($result->getAccount()->getGold() < $result->getCharacter()->getGoldUnlock()) {
                Functions::handleResponse(Messages::$insufficientGold);
            }
            AccountService::updateGold($result->getAccount()->getGold() - $result->getCharacter()->getGoldUnlock());
        }
    }

    /**
     * @throws CustomException
     */
    private static function validateCharacterRequirements(CharacterRepository $characterRepository, int $id, PaymentEnum $payment): void
    {
        $result = $characterRepository->findCharacterByIdAndAccountCharacterByIdAndAccountById($id);
        if (!$result) {
            Functions::handleResponse(Messages::$characterNotFound);
        }
        self::validatePaymentFreeRequirements($payment, $result);
        $existCharacterId = preg_grep("/$id/", explode(',', $result->getAccountCharacterIds()));
        if ($existCharacterId) {
            Functions::handleResponse(Messages::$characterAlreadyAdded);
        }
        self::payCrew($payment, $result);
    }

    /**
     * @throws CustomException
     */
    private static function validatePaymentFreeRequirements(PaymentEnum $payment, ?CharacterAccountCharacterAccountDTO $result): void
    {
        if ($payment == PaymentEnum::Free &&
            (AccountService::getAccount()->getLevel() < $result->getCharacter()->getPlayerLevelUnlock()
                || $result->getAccountCharacter()->getLevel() < $result->getCharacter()->getCharacterLevelUnlock()
                || $result->getAccountCharacter()->getNpcBattles() < $result->getCharacter()->getCharacterNpcBattlesUnlock()
                || $result->getAccountCharacter()->getArenaBattles() < $result->getCharacter()->getCharacterArenaBattlesUnlock()
                || $result->getAccountCharacter()->getNpcWins() < $result->getCharacter()->getCharacterNpcWinsUnlock()
                || $result->getAccountCharacter()->getArenaWins() < $result->getCharacter()->getCharacterArenaWinsUnlock())) {
            Functions::handleResponse(Messages::$necessaryRequirements);
        }
    }
}