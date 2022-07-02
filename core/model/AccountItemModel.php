<?php

namespace core\model;

use core\enum\YesNoEnum;

class AccountItemModel
{

    private int $accountId;
    private int $id;
    private int $itemId;
    private int $level;
    private YesNoEnum $linked;

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
}