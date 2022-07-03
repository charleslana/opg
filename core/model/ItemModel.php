<?php

namespace core\model;

use core\classes\Functions;
use core\enum\ItemTypeEnum;
use core\enum\RarityEnum;
use core\enum\YesNoEnum;

class ItemModel
{

    private ?int $agility;
    private ClassModel $class;
    private ?int $defense;
    private ?string $description;
    private ?int $energy;
    private int $id;
    private int $image;
    private ?int $life;
    private YesNoEnum $linked;
    private int $minimumLevel;
    private string $name;
    private RarityEnum $rarity;
    private ?int $resistance;
    private ?int $strength;
    private ItemTypeEnum $type;

    /**
     * @return int|null
     */
    public function getAgility(): ?int
    {
        return $this->agility;
    }

    /**
     * @param int|null $agility
     */
    public function setAgility(?int $agility): void
    {
        $this->agility = $agility;
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
     * @return int|null
     */
    public function getDefense(): ?int
    {
        return $this->defense;
    }

    /**
     * @param int|null $defense
     */
    public function setDefense(?int $defense): void
    {
        $this->defense = $defense;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int|null
     */
    public function getEnergy(): ?int
    {
        return $this->energy;
    }

    /**
     * @param int|null $energy
     */
    public function setEnergy(?int $energy): void
    {
        $this->energy = $energy;
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
     * @return int
     */
    public function getImage(): int
    {
        return $this->image;
    }

    /**
     * @param int $image
     */
    public function setImage(int $image): void
    {
        $this->image = $image;
    }

    /**
     * @return int|null
     */
    public function getLife(): ?int
    {
        return $this->life;
    }

    /**
     * @param int|null $life
     */
    public function setLife(?int $life): void
    {
        $this->life = $life;
    }

    /**
     * @return YesNoEnum
     */
    public function getLinked(): YesNoEnum
    {
        return $this->linked;
    }

    /**
     * @param YesNoEnum $linked
     */
    public function setLinked(YesNoEnum $linked): void
    {
        $this->linked = $linked;
    }

    /**
     * @return int
     */
    public function getMinimumLevel(): int
    {
        return $this->minimumLevel;
    }

    /**
     * @param int $minimumLevel
     */
    public function setMinimumLevel(int $minimumLevel): void
    {
        $this->minimumLevel = $minimumLevel;
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
     * @return RarityEnum
     */
    public function getRarity(): RarityEnum
    {
        return $this->rarity;
    }

    /**
     * @param RarityEnum $rarity
     */
    public function setRarity(RarityEnum $rarity): void
    {
        $this->rarity = $rarity;
    }

    /**
     * @return int|null
     */
    public function getResistance(): ?int
    {
        return $this->resistance;
    }

    /**
     * @param int|null $resistance
     */
    public function setResistance(?int $resistance): void
    {
        $this->resistance = $resistance;
    }

    /**
     * @return int|null
     */
    public function getStrength(): ?int
    {
        return $this->strength;
    }

    /**
     * @param int|null $strength
     */
    public function setStrength(?int $strength): void
    {
        $this->strength = $strength;
    }

    /**
     * @return ItemTypeEnum
     */
    public function getType(): ItemTypeEnum
    {
        return $this->type;
    }

    /**
     * @param ItemTypeEnum $type
     */
    public function setType(ItemTypeEnum $type): void
    {
        $this->type = $type;
    }

    public function toJSON(): string
    {
        return json_encode(Functions::mergeObject(
            get_object_vars($this),
            json_decode($this->getClass()->toJSON()),
        ));
    }
}