<?php

namespace core\service;

class StatusService
{

    public static function calculateAttribute(int $attribute, int $level): int
    {
        return $attribute * $level;
    }

    public static function calculateBar(): int
    {
        $attributes = array_sum(func_get_args());
        if ($attributes <= 0) {
            return 0;
        }
        $result = ((int)func_get_arg(0) * 100) / $attributes;
        if ($result > 100) {
            $result = 100;
        }
        return $result;
    }

    public static function calculateBlocking(int $resistance, int $level): float
    {
        $result = (self::calculateAttribute($resistance, $level) * 10) / 1000;
        if ($result > 50) {
            $result = 50;
        }
        return $result;
    }

    public static function calculateCritical(int $intelligence, int $level): float
    {
        $result = (self::calculateAttribute($intelligence, $level) * 100) / 1000;
        if ($result > 50) {
            $result = 50;
        }
        return $result;
    }

    public static function calculateDamage(int $strength, int $level): int
    {
        return 50 * self::calculateAttribute($strength, $level);
    }

    public static function calculateDodge(int $agility, int $level): float
    {
        $result = (self::calculateAttribute($agility, $level) * 50) / 1000;
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

    public static function calculatePercentageOfValue(int $percentage, int $value): int
    {
        return ($value * $percentage) / 100;
    }

    public static function calculateShield(int $defense, int $level): int
    {
        return 20 * self::calculateAttribute($defense, $level);
    }
}