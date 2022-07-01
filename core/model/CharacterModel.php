<?php

namespace core\model;

use core\classes\Functions;
use core\enum\YesNoEnum;

class CharacterModel
{

    private int $agilityAttributes;
    private YesNoEnum $akumaNoMiUnlock;
    private BreedModel $breed;
    private ?int $characterArenaBattlesUnlock;
    private ?int $characterArenaWinsUnlock;
    private ?int $characterLevelUnlock;
    private ?int $characterNpcBattlesUnlock;
    private ?int $characterNpcWinsUnlock;
    private ClassModel $class;
    private int $defenseAttributes;
    private int $energyAttributes;
    private int $goldUnlock;
    private YesNoEnum $hakiUnlock;
    private int $id;
    private string $image;
    private int $lifeAttributes;
    private int $maximumLevel;
    private string $name;
    private OrganizationModel $organization;
    private ?int $playerLevelUnlock;
    private int $resistanceAttributes;
    private int $strengthAttributes;

    /**
     * @return int
     */
    public function getAgilityAttributes(): int
    {
        return $this->agilityAttributes;
    }

    /**
     * @param int $agilityAttributes
     */
    public function setAgilityAttributes(int $agilityAttributes): void
    {
        $this->agilityAttributes = $agilityAttributes;
    }

    /**
     * @return YesNoEnum
     */
    public function getAkumaNoMiUnlock(): YesNoEnum
    {
        return $this->akumaNoMiUnlock;
    }

    /**
     * @param YesNoEnum $akumaNoMiUnlock
     */
    public function setAkumaNoMiUnlock(YesNoEnum $akumaNoMiUnlock): void
    {
        $this->akumaNoMiUnlock = $akumaNoMiUnlock;
    }

    /**
     * @return BreedModel
     */
    public function getBreed(): BreedModel
    {
        return $this->breed;
    }

    /**
     * @param BreedModel $breed
     */
    public function setBreed(BreedModel $breed): void
    {
        $this->breed = $breed;
    }

    /**
     * @return int|null
     */
    public function getCharacterArenaBattlesUnlock(): ?int
    {
        return $this->characterArenaBattlesUnlock;
    }

    /**
     * @param int|null $characterArenaBattlesUnlock
     */
    public function setCharacterArenaBattlesUnlock(?int $characterArenaBattlesUnlock): void
    {
        $this->characterArenaBattlesUnlock = $characterArenaBattlesUnlock;
    }

    /**
     * @return int|null
     */
    public function getCharacterArenaWinsUnlock(): ?int
    {
        return $this->characterArenaWinsUnlock;
    }

    /**
     * @param int|null $characterArenaWinsUnlock
     */
    public function setCharacterArenaWinsUnlock(?int $characterArenaWinsUnlock): void
    {
        $this->characterArenaWinsUnlock = $characterArenaWinsUnlock;
    }

    /**
     * @return int|null
     */
    public function getCharacterLevelUnlock(): ?int
    {
        return $this->characterLevelUnlock;
    }

    /**
     * @param int|null $characterLevelUnlock
     */
    public function setCharacterLevelUnlock(?int $characterLevelUnlock): void
    {
        $this->characterLevelUnlock = $characterLevelUnlock;
    }

    /**
     * @return int|null
     */
    public function getCharacterNpcBattlesUnlock(): ?int
    {
        return $this->characterNpcBattlesUnlock;
    }

    /**
     * @param int|null $characterNpcBattlesUnlock
     */
    public function setCharacterNpcBattlesUnlock(?int $characterNpcBattlesUnlock): void
    {
        $this->characterNpcBattlesUnlock = $characterNpcBattlesUnlock;
    }

    /**
     * @return int|null
     */
    public function getCharacterNpcWinsUnlock(): ?int
    {
        return $this->characterNpcWinsUnlock;
    }

    /**
     * @param int|null $characterNpcWinsUnlock
     */
    public function setCharacterNpcWinsUnlock(?int $characterNpcWinsUnlock): void
    {
        $this->characterNpcWinsUnlock = $characterNpcWinsUnlock;
    }

    /**
     * @return ClassModel
     */
    public function getClass(): ClassModel
    {
        return $this->class;
    }

    /**
     * @param ClassModel $class
     */
    public function setClass(ClassModel $class): void
    {
        $this->class = $class;
    }

    /**
     * @return int
     */
    public function getDefenseAttributes(): int
    {
        return $this->defenseAttributes;
    }

    /**
     * @param int $defenseAttributes
     */
    public function setDefenseAttributes(int $defenseAttributes): void
    {
        $this->defenseAttributes = $defenseAttributes;
    }

    /**
     * @return int
     */
    public function getEnergyAttributes(): int
    {
        return $this->energyAttributes;
    }

    /**
     * @param int $energyAttributes
     */
    public function setEnergyAttributes(int $energyAttributes): void
    {
        $this->energyAttributes = $energyAttributes;
    }

    /**
     * @return int
     */
    public function getGoldUnlock(): int
    {
        return $this->goldUnlock;
    }

    /**
     * @param int $goldUnlock
     */
    public function setGoldUnlock(int $goldUnlock): void
    {
        $this->goldUnlock = $goldUnlock;
    }

    /**
     * @return YesNoEnum
     */
    public function getHakiUnlock(): YesNoEnum
    {
        return $this->hakiUnlock;
    }

    /**
     * @param YesNoEnum $hakiUnlock
     */
    public function setHakiUnlock(YesNoEnum $hakiUnlock): void
    {
        $this->hakiUnlock = $hakiUnlock;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getLifeAttributes(): int
    {
        return $this->lifeAttributes;
    }

    /**
     * @param int $lifeAttributes
     */
    public function setLifeAttributes(int $lifeAttributes): void
    {
        $this->lifeAttributes = $lifeAttributes;
    }

    /**
     * @return int
     */
    public function getMaximumLevel(): int
    {
        return $this->maximumLevel;
    }

    /**
     * @param int $maximumLevel
     */
    public function setMaximumLevel(int $maximumLevel): void
    {
        $this->maximumLevel = $maximumLevel;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return OrganizationModel
     */
    public function getOrganization(): OrganizationModel
    {
        return $this->organization;
    }

    /**
     * @param OrganizationModel $organization
     */
    public function setOrganization(OrganizationModel $organization): void
    {
        $this->organization = $organization;
    }

    /**
     * @return int|null
     */
    public function getPlayerLevelUnlock(): ?int
    {
        return $this->playerLevelUnlock;
    }

    /**
     * @param int|null $playerLevelUnlock
     */
    public function setPlayerLevelUnlock(?int $playerLevelUnlock): void
    {
        $this->playerLevelUnlock = $playerLevelUnlock;
    }

    /**
     * @return int
     */
    public function getResistanceAttributes(): int
    {
        return $this->resistanceAttributes;
    }

    /**
     * @param int $resistanceAttributes
     */
    public function setResistanceAttributes(int $resistanceAttributes): void
    {
        $this->resistanceAttributes = $resistanceAttributes;
    }

    /**
     * @return int
     */
    public function getStrengthAttributes(): int
    {
        return $this->strengthAttributes;
    }

    /**
     * @param int $strengthAttributes
     */
    public function setStrengthAttributes(int $strengthAttributes): void
    {
        $this->strengthAttributes = $strengthAttributes;
    }

    public function toJSON(): string
    {
        return json_encode(Functions::mergeObject(
            get_object_vars($this),
            json_decode($this->getBreed()->toJSON()),
            json_decode($this->getClass()->toJSON()),
            json_decode($this->getOrganization()->toJSON())
        ));
    }
}