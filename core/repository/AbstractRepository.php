<?php

namespace core\repository;

use core\enum\RoleEnum;
use core\enum\StatusEnum;
use core\enum\YesNoEnum;
use core\model\AccountCharacterModel;
use core\model\AccountModel;
use core\model\BreedModel;
use core\model\CharacterModel;
use core\model\ClassModel;
use core\model\OrganizationModel;
use DateTime;
use Exception;

abstract class AbstractRepository
{

    /**
     * @throws Exception
     */
    protected function getAccountAbstract(object $object): AccountModel
    {
        $accountModel = new AccountModel();
        $accountModel->setId($object->id);
        $accountModel->setEmail($object->email);
        $accountModel->setPassword($object->password);
        $accountModel->setName($object->name);
        $accountModel->setStatus(StatusEnum::from($object->status));
        $accountModel->setToken($object->token);
        $accountModel->setRole(RoleEnum::from($object->role));
        $this->setAccountCompleteData($accountModel, $object);
        return $accountModel;
    }

    /**
     * @throws Exception
     */
    protected function getAccountCharacterAbstract(object $object): AccountCharacterModel
    {
        $accountCharacterModel = new AccountCharacterModel();
        $accountCharacterModel->setId($object->id);
        $accountCharacterModel->setAccountId($object->account_id);
        $accountCharacterModel->setCharacterId($object->character_id);
        $accountCharacterModel->setLevel($object->level);
        $accountCharacterModel->setNpcBattles($object->npc_battles);
        $accountCharacterModel->setNpcWins($object->npc_wins);
        $accountCharacterModel->setNpcDefeats($object->npc_defeats);
        $this->setAccountCharacterCompleteData($accountCharacterModel, $object);
        return $accountCharacterModel;
    }

    protected function getCharacterAbstract(object $object): CharacterModel
    {
        $characterModel = new CharacterModel();
        $characterModel->setId($object->id);
        $characterModel->setAgilityAttributes($object->agility_attributes);
        $characterModel->setAkumaNoMiUnlock(YesNoEnum::from($object->akuma_no_mi_unlock));
        $characterModel->setCharacterArenaBattlesUnlock($object->character_arena_battles_unlock);
        $characterModel->setCharacterArenaWinsUnlock($object->character_arena_wins_unlock);
        $characterModel->setCharacterLevelUnlock($object->character_level_unlock);
        $characterModel->setCharacterNpcBattlesUnlock($object->character_npc_battles_unlock);
        $characterModel->setCharacterNpcWinsUnlock($object->character_npc_wins_unlock);
        $characterModel->setDefenseAttributes($object->defense_attributes);
        $characterModel->setEnergyAttributes($object->energy_attributes);
        $this->setCharacterCompleteData($characterModel, $object);
        return $characterModel;
    }

    private function getBreedAbstract(object $object): BreedModel
    {
        $breedModel = new BreedModel();
        $breedModel->setId($object->breedId);
        $breedModel->setName($object->breedName);
        return $breedModel;
    }

    private function getClassAbstract(object $object): ClassModel
    {
        $classModel = new ClassModel();
        $classModel->setId($object->classId);
        $classModel->setName($object->className);
        return $classModel;
    }

    private function getOrganizationAbstract(object $object): OrganizationModel
    {
        $organizationModel = new OrganizationModel();
        $organizationModel->setId($object->organizationId);
        $organizationModel->setName($object->organizationName);
        return $organizationModel;
    }

    /**
     * @throws Exception
     */
    private function setAccountCharacterCompleteData(AccountCharacterModel $accountCharacterModel, object $object): void
    {
        $accountCharacterModel->setNpcDraws($object->npc_draws);
        $accountCharacterModel->setArenaBattles($object->arena_battles);
        $accountCharacterModel->setArenaWins($object->arena_wins);
        $accountCharacterModel->setArenaDefeats($object->arena_defeats);
        $accountCharacterModel->setArenaDraws($object->arena_draws);
        $accountCharacterModel->setLife($object->life);
        $accountCharacterModel->setEnergy($object->energy);
        $accountCharacterModel->setCreatedAt(new DateTime($object->created_at));
        $accountCharacterModel->setUpdatedAt(new DateTime($object->updated_at));
    }

    /**
     * @throws Exception
     */
    private function setAccountCompleteData(AccountModel $accountModel, object $object): void
    {
        $accountModel->setSession($object->session);
        $accountModel->setLevel($object->level);
        $accountModel->setBelly($object->belly);
        $accountModel->setGold($object->gold);
        $accountModel->setAvatar($object->avatar);
        $accountModel->setExperience($object->experience);
        $accountModel->setCreatedAt(new DateTime($object->created_at));
        $accountModel->setUpdatedAt(new DateTime($object->updated_at));
        $accountModel->setDeletedAt($object->deleted_at == null ? null : new DateTime($object->deleted_at));
    }

    private function setCharacterCompleteData(CharacterModel $characterModel, object $object): void
    {
        $characterModel->setGoldUnlock($object->gold_unlock);
        $characterModel->setHakiUnlock(YesNoEnum::from($object->haki_unlock));
        $characterModel->setImage($object->image);
        $characterModel->setLifeAttributes($object->life_attributes);
        $characterModel->setMaximumLevel($object->maximum_level);
        $characterModel->setName($object->name);
        $characterModel->setPlayerLevelUnlock($object->player_level_unlock);
        $characterModel->setResistanceAttributes($object->resistance_attributes);
        $characterModel->setStrengthAttributes($object->strength_attributes);
        $characterModel->setIntelligenceAttributes($object->intelligence_attributes);
        $this->setClassAndBreedAndOrganization($object, $characterModel);
    }

    private function setClassAndBreedAndOrganization(object $object, CharacterModel $characterModel): void
    {
        $characterModel->setClass($this->getClassAbstract($object));
        $characterModel->setBreed($this->getBreedAbstract($object));
        $characterModel->setOrganization($this->getOrganizationAbstract($object));
    }
}