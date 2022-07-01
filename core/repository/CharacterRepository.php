<?php

namespace core\repository;

use core\classes\Database;
use core\exception\CustomException;
use core\model\AccountCharacterModel;
use core\model\AccountModel;
use core\model\CharacterModel;
use core\model\dto\CharacterAccountCharacterAccountDTO;
use core\service\AccountService;

class CharacterRepository extends AbstractRepository
{

    /**
     * @return CharacterModel[]
     * @throws CustomException
     */
    public function findAllByCharacterWithPagination(int $page, int $size): array
    {
        $database = new Database();
        $results = $database->select("SELECT id, image FROM `character` LIMIT $page,$size");
        $characters = [];
        foreach ($results as $result) {
            $characterModel = new CharacterModel();
            $characterModel->setId($result->id);
            $characterModel->setImage($result->image);
            $characters[] = $characterModel;
        }
        return $characters;
    }

    /**
     * @throws CustomException
     */
    public function findCharacterByIdAndAccountCharacterByIdAndAccountById(int $id): ?CharacterAccountCharacterAccountDTO
    {
        $parameters = [':id' => $id, ':accountId' => AccountService::getAccountId()];
        $database = new Database();
        $result = $database->select('
            SELECT c.*, ac.*, a.level AS accountLevel, a.gold AS accountGold, ac2.accountCharacterIds, cl.id AS classId, cl.name AS className, b.id AS breedId, b.name AS breedName, o.id AS organizationId, o.name AS organizationName FROM `character` c
                LEFT OUTER JOIN (SELECT MAX(level) AS level, MAX(npc_battles) AS npc_battles, MAX(arena_battles) AS arena_battles, MAX(npc_wins) AS npc_wins, MAX(arena_wins) AS arena_wins
                                 FROM account_character WHERE account_id = :accountId LIMIT 1) ac ON (c.id = c.id)
                LEFT OUTER JOIN (SELECT GROUP_CONCAT(character_id) AS accountCharacterIds FROM account_character WHERE account_id = :accountId) ac2 ON (c.id = c.id)
                LEFT OUTER JOIN class cl ON (cl.id = c.class_id)
                LEFT OUTER JOIN breed b ON (b.id = c.breed_id)
                LEFT OUTER JOIN organization o ON (o.id = c.organization_id)
                LEFT OUTER JOIN account a ON (a.id = :accountId)
                        WHERE c.id = :id
            ', $parameters
        );
        if (count($result) != 1) {
            return null;
        }
        return $this->setFindCharacterByIdAndAccountCharacterByIdAndAccountById($result[0]);
    }

    /**
     * @throws CustomException
     */
    public function saveCharacter(int $id): bool
    {
        $parameters = [':characterId' => $id, ':accountId' => AccountService::getAccountId()];
        $database = new Database();
        return $database->insert('INSERT INTO account_character (account_id, character_id) VALUES (:accountId, :characterId)', $parameters);
    }

    private function getAccountModel(object $object): AccountModel
    {
        $account = new AccountModel();
        $account->setGold($object->accountGold);
        $account->setLevel($object->accountLevel);
        return $account;
    }

    private function setFindCharacterByIdAndAccountCharacterByIdAndAccountById(object $object): CharacterAccountCharacterAccountDTO
    {
        $accountCharacterModel = new AccountCharacterModel();
        $accountCharacterModel->setLevel($object->level);
        $accountCharacterModel->setNpcBattles($object->npc_battles);
        $accountCharacterModel->setArenaBattles($object->arena_battles);
        $accountCharacterModel->setNpcWins($object->npc_wins);
        $accountCharacterModel->setArenaWins($object->arena_wins);
        $dto = new CharacterAccountCharacterAccountDTO();
        $dto->setCharacter($this->getCharacterAbstract($object));
        $dto->setAccountCharacter($accountCharacterModel);
        $dto->setAccount($this->getAccountModel($object));
        $dto->setAccountCharacterIds($object->accountCharacterIds);
        return $dto;
    }
}