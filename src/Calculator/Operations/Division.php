<?php

namespace App\Calculator\Operations;

use App\Calculator\Calculatable;

class Division extends Calculatable
{
    public static function getName(): string
    {
        return 'division';
    }

    public static function getDisplayOperation(): string
    {
        return '/';
    }

    public function calculate(array $parameters)
    {
        return $parameters[0] / $parameters[1];
    }
}
