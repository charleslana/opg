<?php

namespace core\enum;

enum ItemTypeEnum: string
{
    case Accessory = 'accessory';
    case Clothing = 'clothing';
    case Helmet = 'helmet';
    case Shoe = 'shoe';
    case Weapon = 'weapon';
}