<?php

namespace core\enum;

enum RarityEnum: string
{
    case Common = 'common';
    case Epic = 'epic';
    case Legendary = 'legendary';
    case Mythical = 'mythical';
    case Rare = 'rare';
}