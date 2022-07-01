<?php

namespace core\model\dto;

use core\model\AccountCharacterModel;
use core\model\CharacterModel;
use stdClass;

class CharacterAccountCharacterDTO
{

    private AccountCharacterModel $accountCharacter;
    private CharacterModel $character;

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
        $stdClass->accountCharacter = json_decode($this->accountCharacter->toJSON());
        $stdClass->character = json_decode($this->character->toJSON());
        return json_encode($stdClass);
    }
}