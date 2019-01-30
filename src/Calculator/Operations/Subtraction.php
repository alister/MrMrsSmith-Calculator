<?php

namespace App\Calculator\Operations;

use App\Calculator\Calculatable;

class Subtraction implements Calculatable
{
    public static function getName(): string
    {
        return 'subtraction';
    }

    public static function getDisplayOperation(): string
    {
        return '-';
    }

    public function calculate(array $parameters)
    {
        return $parameters[0] - $parameters[1];
    }

    public function match(string $name): bool
    {
        return $name === self::getName();
    }
}
