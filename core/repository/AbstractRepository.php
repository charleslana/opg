<?php

namespace core\repository;

use core\enum\ItemTypeEnum;
use core\enum\RarityEnum;
use core\enum\RoleEnum;
use core\enum\StatusEnum;
use core\enum\YesNoEnum;
use core\model\AccountCharacterModel;
use core\model\AccountItemModel;
use core\model\AccountModel;
use core\model\BreedModel;
use core\model\CharacterModel;
use core\model\ClassModel;
use core\model\ItemModel;
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
        $model = new AccountModel();
        $model->setId($object->id);
        $model->setEmail($object->email);
        $model->setPassword($object->password);
        $model->setName($object->name);
        $model->setStatus(StatusEnum::from($object->status));
        $model->setToken($object->token);
        $model->setRole(RoleEnum::from($object->role));
        $this->setAccountCompleteData($model, $object);
        return $model;
    }

    /**
     * @throws Exception
     */
    protected function getAccountCharacterAbstract(object $object): AccountCharacterModel
    {
        $model = new AccountCharacterModel();
        $model->setId($object->id);
        $model->setAccountId($object->account_id);
        $model->setCharacterId($object->character_id);
        $model->setLevel($object->level);
        $model->setNpcBattles($object->npc_battles);
        $model->setNpcWins($object->npc_wins);
        $model->setNpcDefeats($object->npc_defeats);
        $this->setAccountCharacterCompleteData($model, $object);
        return $model;
    }

    protected function getAccountItemAbstract(object $object): AccountItemModel
    {
        $model = new AccountItemModel();
        $model->setId($object->accountItemId);
        $model->setAccountId($object->account_id);
        $model->setAccountCharacterId($object->account_character_id);
        $model->setItemId($object->item_id);
        $model->setLevel($object->level);
        $model->setLinked(YesNoEnum::from($object->accountItemLinked));
        $model->setChest(YesNoEnum::from($object->chest));
        $model->setEquipped(YesNoEnum::from($object->equipped));
        return $model;
    }

    protected function getCharacterAbstract(object $object): CharacterModel
    {
        $model = new CharacterModel();
        $model->setId($object->id);
        $model->setAgilityAttributes($object->agility_attributes);
        $model->setAkumaNoMiUnlock(YesNoEnum::from($object->akuma_no_mi_unlock));
        $model->setCharacterArenaBattlesUnlock($object->character_arena_battles_unlock);
        $model->setCharacterArenaWinsUnlock($object->character_arena_wins_unlock);
        $model->setCharacterLevelUnlock($object->character_level_unlock);
        $model->setCharacterNpcBattlesUnlock($object->character_npc_battles_unlock);
        $model->setCharacterNpcWinsUnlock($object->character_npc_wins_unlock);
        $model->setDefenseAttributes($object->defense_attributes);
        $model->setEnergyAttributes($object->energy_attributes);
        $this->setCharacterCompleteData($model, $object);
        return $model;
    }

    protected function getItemAbstract(object $object): ItemModel
    {
        $model = new ItemModel();
        $model->setId($object->id);
        $model->setClass($this->getClassAbstract($object));
        $model->setImage($object->image);
        $model->setName($object->name);
        $model->setDescription($object->description);
        $model->setStrength($object->strength);
        $model->setDefense($object->defense);
        $this->setItemCompleteData($model, $object);
        return $model;
    }

    private function getBreedAbstract(object $object): BreedModel
    {
        $model = new BreedModel();
        $model->setId($object->breedId);
        $model->setName($object->breedName);
        return $model;
    }

    private function getClassAbstract(object $object): ClassModel
    {
        $model = new ClassModel();
        $model->setId($object->classId);
        $model->setName($object->className);
        return $model;
    }

    private function getOrganizationAbstract(object $object): OrganizationModel
    {
        $model = new OrganizationModel();
        $model->setId($object->organizationId);
        $model->setName($object->organizationName);
        return $model;
    }

    /**
     * @throws Exception
     */
    private function setAccountCharacterCompleteData(AccountCharacterModel $model, object $object): void
    {
        $model->setNpcDraws($object->npc_draws);
        $model->setArenaBattles($object->arena_battles);
        $model->setArenaWins($object->arena_wins);
        $model->setArenaDefeats($object->arena_defeats);
        $model->setArenaDraws($object->arena_draws);
        $model->setLife($object->life);
        $model->setEnergy($object->energy);
        $model->setCreatedAt(new DateTime($object->created_at));
        $model->setUpdatedAt(new DateTime($object->updated_at));
    }

    /**
     * @throws Exception
     */
    private function setAccountCompleteData(AccountModel $model, object $object): void
    {
        $model->setSession($object->session);
        $model->setLevel($object->level);
        $model->setBelly($object->belly);
        $model->setGold($object->gold);
        $model->setAvatar($object->avatar);
        $model->setExperience($object->experience);
        $model->setCreatedAt(new DateTime($object->created_at));
        $model->setUpdatedAt(new DateTime($object->updated_at));
        $model->setDeletedAt($object->deleted_at == null ? null : new DateTime($object->deleted_at));
    }

    private function setCharacterCompleteData(CharacterModel $model, object $object): void
    {
        $model->setGoldUnlock($object->gold_unlock);
        $model->setHakiUnlock(YesNoEnum::from($object->haki_unlock));
        $model->setImage($object->image);
        $model->setLifeAttributes($object->life_attributes);
        $model->setMaximumLevel($object->maximum_level);
        $model->setName($object->name);
        $model->setPlayerLevelUnlock($object->player_level_unlock);
        $model->setResistanceAttributes($object->resistance_attributes);
        $model->setStrengthAttributes($object->strength_attributes);
        $model->setIntelligenceAttributes($object->intelligence_attributes);
        $this->setClassAndBreedAndOrganization($object, $model);
    }

    private function setClassAndBreedAndOrganization(object $object, CharacterModel $model): void
    {
        $model->setClass($this->getClassAbstract($object));
        $model->setBreed($this->getBreedAbstract($object));
        $model->setOrganization($this->getOrganizationAbstract($object));
    }

    private function setItemCompleteData(ItemModel $model, object $object): void
    {
        $model->setLife($object->life);
        $model->setEnergy($object->energy);
        $model->setAgility($object->agility);
        $model->setResistance($object->resistance);
        $model->setMinimumLevel($object->minimum_level);
        $model->setType(ItemTypeEnum::from($object->type));
        $model->setRarity(RarityEnum::from($object->rarity));
        $model->setLinked(YesNoEnum::from($object->linked));
    }
}