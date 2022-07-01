<?php

namespace core\model;

use DateTime;

class AccountCharacterModel
{

    private int $accountId;
    private ?int $arenaBattles;
    private int $arenaDefeats;
    private int $arenaDraws;
    private ?int $arenaWins;
    private int $characterId;
    private DateTime $createdAt;
    private int $energy;
    private int $id;
    private ?int $level;
    private int $life;
    private ?int $npcBattles;
    private int $npcDefeats;
    private int $npcDraws;
    private ?int $npcWins;
    private DateTime $updatedAt;

    /**
     * @return int
     */
    public function getAccountId(): int
    {
        return $this->accountId;
    }

    /**
     * @param int $accountId
     */
    public function setAccountId(int $accountId): void
    {
        $this->accountId = $accountId;
    }

    /**
     * @return int|null
     */
    public function getArenaBattles(): ?int
    {
        return $this->arenaBattles;
    }

    /**
     * @param int|null $arenaBattles
     */
    public function setArenaBattles(?int $arenaBattles): void
    {
        $this->arenaBattles = $arenaBattles;
    }

    /**
     * @return int
     */
    public function getArenaDefeats(): int
    {
        return $this->arenaDefeats;
    }

    /**
     * @param int $arenaDefeats
     */
    public function setArenaDefeats(int $arenaDefeats): void
    {
        $this->arenaDefeats = $arenaDefeats;
    }

    /**
     * @return int
     */
    public function getArenaDraws(): int
    {
        return $this->arenaDraws;
    }

    /**
     * @param int $arenaDraws
     */
    public function setArenaDraws(int $arenaDraws): void
    {
        $this->arenaDraws = $arenaDraws;
    }

    /**
     * @return int|null
     */
    public function getArenaWins(): ?int
    {
        return $this->arenaWins;
    }

    /**
     * @param int|null $arenaWins
     */
    public function setArenaWins(?int $arenaWins): void
    {
        $this->arenaWins = $arenaWins;
    }

    /**
     * @return int
     */
    public function getCharacterId(): int
    {
        return $this->characterId;
    }

    /**
     * @param int $characterId
     */
    public function setCharacterId(int $characterId): void
    {
        $this->characterId = $characterId;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return int
     */
    public function getEnergy(): int
    {
        return $this->energy;
    }

    /**
     * @param int $energy
     */
    public function setEnergy(int $energy): void
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
    public function getLevel(): ?int
    {
        return $this->level;
    }

    /**
     * @param int|null $level
     */
    public function setLevel(?int $level): void
    {
        $this->level = $level;
    }

    /**
     * @return int
     */
    public function getLife(): int
    {
        return $this->life;
    }

    /**
     * @param int $life
     */
    public function setLife(int $life): void
    {
        $this->life = $life;
    }

    /**
     * @return int|null
     */
    public function getNpcBattles(): ?int
    {
        return $this->npcBattles;
    }

    /**
     * @param int|null $npcBattles
     */
    public function setNpcBattles(?int $npcBattles): void
    {
        $this->npcBattles = $npcBattles;
    }

    /**
     * @return int
     */
    public function getNpcDefeats(): int
    {
        return $this->npcDefeats;
    }

    /**
     * @param int $npcDefeats
     */
    public function setNpcDefeats(int $npcDefeats): void
    {
        $this->npcDefeats = $npcDefeats;
    }

    /**
     * @return int
     */
    public function getNpcDraws(): int
    {
        return $this->npcDraws;
    }

    /**
     * @param int $npcDraws
     */
    public function setNpcDraws(int $npcDraws): void
    {
        $this->npcDraws = $npcDraws;
    }

    /**
     * @return int|null
     */
    public function getNpcWins(): ?int
    {
        return $this->npcWins;
    }

    /**
     * @param int|null $npcWins
     */
    public function setNpcWins(?int $npcWins): void
    {
        $this->npcWins = $npcWins;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function toJSON(): string
    {
        return json_encode(get_object_vars($this));
    }
}