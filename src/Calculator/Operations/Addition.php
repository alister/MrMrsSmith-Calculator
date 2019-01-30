<?php

namespace App\Calculator\Operations;

use App\Calculator\Calculatable;

class Addition extends Calculatable
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
        return array_sum($parameters);
    }
}
