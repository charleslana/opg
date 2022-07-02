<?php

namespace core\model;

use core\enum\RarityEnum;
use core\enum\YesNoEnum;

class ItemModel
{

    private ?int $agility;
    private ?int $defense;
    private ?string $description;
    private ?int $energy;
    private int $id;
    private ?int $life;
    private YesNoEnum $linked;
    private int $minimumLevel;
    private string $name;
    private RarityEnum $rarity;
    private ?int $resistance;
    private ?int $strength;

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

    public function toJSON(): string
    {
        return json_encode(get_object_vars($this));
    }
}