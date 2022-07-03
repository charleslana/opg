<?php

namespace core\model\dto;

use core\model\AccountItemModel;
use core\model\ItemModel;
use stdClass;

class ItemAccountItemDTO
{

    private AccountItemModel $accountItem;
    private ItemModel $item;

    /**
     * @return AccountItemModel
     */
    public function getAccountItem(): AccountItemModel
    {
        return $this->accountItem;
    }

    /**
     * @param AccountItemModel $accountItem
     */
    public function setAccountItem(AccountItemModel $accountItem): void
    {
        $this->accountItem = $accountItem;
    }

    /**
     * @return ItemModel
     */
    public function getItem(): ItemModel
    {
        return $this->item;
    }

    /**
     * @param ItemModel $item
     */
    public function setItem(ItemModel $item): void
    {
        $this->item = $item;
    }

    public function toJSON(): string
    {
        $stdClass = new stdClass();
        $stdClass->accountItem = json_decode($this->accountItem->toJSON());
        $stdClass->item = json_decode($this->item->toJSON());
        return json_encode($stdClass);
    }
}