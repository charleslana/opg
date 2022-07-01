<?php

namespace core\model\dto;

use core\model\AccountCharacterModel;
use core\model\AccountModel;
use core\model\CharacterModel;
use stdClass;

class CharacterAccountCharacterAccountDTO
{

    private AccountModel $account;
    private AccountCharacterModel $accountCharacter;
    private ?string $accountCharacterIds;
    private CharacterModel $character;

    /**
     * @return AccountModel
     */
    public function getAccount(): AccountModel
    {
        return $this->account;
    }

    /**
     * @param AccountModel $account
     */
    public function setAccount(AccountModel $account): void
    {
        $this->account = $account;
    }

    /**
     * @return AccountCharacterModel
     */
    public function getAccountCharacter(): AccountCharacterModel
    {
        return $this->accountCharacter;
    }

    /**
     * @param AccountCharacterModel $accountCharacter
     */
    public function setAccountCharacter(AccountCharacterModel $accountCharacter): void
    {
        $this->accountCharacter = $accountCharacter;
    }

    /**
     * @return string|null
     */
    public function getAccountCharacterIds(): ?string
    {
        return $this->accountCharacterIds;
    }

    /**
     * @param string|null $accountCharacterIds
     */
    public function setAccountCharacterIds(?string $accountCharacterIds): void
    {
        $this->accountCharacterIds = $accountCharacterIds;
    }

    /**
     * @return CharacterModel
     */
    public function getCharacter(): CharacterModel
    {
        return $this->character;
    }

    /**
     * @param CharacterModel $character
     */
    public function setCharacter(CharacterModel $character): void
    {
        $this->character = $character;
    }

    public function toJSON(): string
    {
        $stdClass = new stdClass();
        $stdClass->account = json_decode($this->account->toJSON());
        $stdClass->accountCharacter = json_decode($this->accountCharacter->toJSON());
        $stdClass->accountCharacterIds = $this->accountCharacterIds;
        $stdClass->character = json_decode($this->character->toJSON());
        return json_encode($stdClass);
    }
}