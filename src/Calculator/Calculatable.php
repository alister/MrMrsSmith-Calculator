<?php

namespace App\Calculator;

abstract class Calculatable
{
    abstract public static function getName(): string;
    abstract public static function getDisplayOperation(): string;

    abstract public function calculate(array $parameters);

    public function match(string $name): bool
    {
        return $name === static::getName();
    }
}
