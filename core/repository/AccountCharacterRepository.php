<?php

namespace core\repository;

use core\classes\Database;
use core\exception\CustomException;
use core\model\AccountCharacterModel;
use core\model\CharacterModel;
use core\model\dto\CharacterAccountCharacterDTO;
use Exception;

class AccountCharacterRepository extends AbstractRepository
{

    /**
     * @return CharacterAccountCharacterDTO[]
     * @throws CustomException
     */
    public function findAllByAccountCharacterAndCharacterWithPagination(int $accountId, int $page, int $size): array
    {
        $parameters = [':accountId' => $accountId];
        $database = new Database();
        $results = $database->select("
            SELECT ac.*, c.image, c.name FROM account_character ac
                LEFT OUTER JOIN `character` c ON (c.id = ac.character_id)
                    WHERE ac.account_id = :accountId ORDER BY ac.level DESC, ac.id LIMIT $page,$size
            ", $parameters
        );
        return $this->setFindAllByAccountCharacterAndCharacterWithPagination($results);
    }

    /**
     * @throws CustomException
     * @throws Exception
     */
    public function findByCharacter(int $id, int $accountId): ?CharacterAccountCharacterDTO
    {
        $parameters = [':id' => $id, ':accountId' => $accountId];
        $database = new Database();
        $result = $database->select('
            SELECT ac.*, ac.id AS accountCharacterId, c.*, cl.id AS classId, cl.name AS className, b.id AS breedId, b.name AS breedName, o.id AS organizationId, o.name AS organizationName FROM account_character ac
                LEFT OUTER JOIN `character` c ON (c.id = ac.character_id)
                LEFT OUTER JOIN class cl ON (cl.id = c.class_id)
                LEFT OUTER JOIN breed b ON (b.id = c.breed_id)
                LEFT OUTER JOIN organization o ON (o.id = c.organization_id)
                    WHERE ac.id = :id AND ac.account_id = :accountId
            ', $parameters);
        if (count($result) != 1) {
            return null;
        }
        return $this->setFindByCharacter($result[0]);
    }

    /**
     * @return CharacterAccountCharacterDTO[]
     */
    private function setFindAllByAccountCharacterAndCharacterWithPagination(array $results): array
    {
        $array = [];
        foreach ($results as $result) {
            $accountCharacterModel = new AccountCharacterModel();
            $accountCharacterModel->setId($result->id);
            $accountCharacterModel->setLevel($result->level);
            $characterModel = new CharacterModel();
            $characterModel->setName($result->name);
            $characterModel->setImage($result->image);
            $dto = new CharacterAccountCharacterDTO();
            $dto->setAccountCharacter($accountCharacterModel);
            $dto->setCharacter($characterModel);
            $array[] = $dto;
        }
        return $array;
    }

    /**
     * @throws Exception
     */
    private function setFindByCharacter(object $object): CharacterAccountCharacterDTO
    {
        $dto = new CharacterAccountCharacterDTO();
        $accountCharacterModel = $this->getAccountCharacterAbstract($object);
        $accountCharacterModel->setId($object->accountCharacterId);
        $dto->setAccountCharacter($accountCharacterModel);
        $dto->setCharacter($this->getCharacterAbstract($object));
        return $dto;
    }
}