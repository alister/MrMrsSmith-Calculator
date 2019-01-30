<?php

namespace App\Calculator;

interface Calculatable
{
    public static function getName(): string;
    public static function getDisplayOperation(): string;

    public function calculate(array $parameters);
    public function match(string $name): bool;
}
