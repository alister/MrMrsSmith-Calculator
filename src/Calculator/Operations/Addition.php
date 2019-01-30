<?php

namespace App\Calculator\Operations;

use App\Calculator\Calculatable;

class Addition implements Calculatable
{
    public static function getName(): string
    {
        return 'addition';
    }

    public static function getDisplayOperation(): string
    {
        return '+';
    }

    public function calculate(array $parameters)
    {
        return 0;
    }
    public function match(string $name): bool
    {
        return false;
    }
}
