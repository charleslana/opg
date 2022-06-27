<?php

namespace core\service;

class StatusService
{

    public static function calculateAttribute(int $attribute, int $level): int
    {
        return $attribute * $level;
    }

    public static function calculateCritical(int $agility, int $level): float
    {
        $result = (self::calculateAttribute($agility, $level) * 100) / 1000;
        if ($result > 50) {
            $result = 50;
        }
        return $result;
    }

    public static function calculateDamage(int $strength, int $level): int
    {
        return 50 * self::calculateAttribute($strength, $level);
    }

    public static function calculateDodge(int $resistance, int $level): float
    {
        $result = (self::calculateAttribute($resistance, $level) * 50) / 1000;
        if ($result > 50) {
            $result = 50;
        }
        return $result;
    }

    public static function calculateEnergy(int $energy, int $level): int
    {
        return 700 + self::calculateAttribute($energy, $level);
    }

    public static function calculateLife(int $life, int $level): int
    {
        return 1000 + self::calculateAttribute($life, $level);
    }

    public static function calculateShield(int $defense, int $level): int
    {
        return 20 * self::calculateAttribute($defense, $level);
    }
}