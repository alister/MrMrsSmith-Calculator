<?php

namespace App\Calculator;

/**
 * Given a list of tagged services, store them for use.
 */
class OperatorList
{
    private $operators;

    public function __construct(iterable $operators)
    {
        /** @var \App\Calculator\Calculatable $operator */
        foreach ($operators as $operator) {
            $this->operators[$operator::getName()] = $operator;
        } 
    }

    public function get()
    {
        return $this->operators;
    }
}
