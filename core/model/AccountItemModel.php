<?php

namespace core\model;

use core\enum\YesNoEnum;

class AccountItemModel
{

    private int $accountCharacterId;
    private int $accountId;
    private YesNoEnum $chest;
    private YesNoEnum $equipped;
    private int $id;
    private int $itemId;
    private int $level;
    private YesNoEnum $linked;

    /**
     * @return int
     */
    public function getAccountCharacterId(): int
    {
        return $this->accountCharacterId;
    }

    /**
     * @param int $accountCharacterId
     */
    public function setAccountCharacterId(int $accountCharacterId): void
    {
        $this->accountCharacterId = $accountCharacterId;
    }

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
     * @return YesNoEnum
     */
    public function getChest(): YesNoEnum
    {
        return $this->chest;
    }

    /**
     * @param YesNoEnum $chest
     */
    public function setChest(YesNoEnum $chest): void
    {
        $this->chest = $chest;
    }

    /**
     * @return YesNoEnum
     */
    public function getEquipped(): YesNoEnum
    {
        return $this->equipped;
    }

    /**
     * @param YesNoEnum $equipped
     */
    public function setEquipped(YesNoEnum $equipped): void
    {
        $this->equipped = $equipped;
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
    public function getItemId(): int
    {
        return $this->itemId;
    }

    /**
     * @param int $itemId
     */
    public function setItemId(int $itemId): void
    {
        $this->itemId = $itemId;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel(int $level): void
    {
        $this->level = $level;
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

    public function toJSON(): string
    {
        return json_encode(get_object_vars($this));
    }
}