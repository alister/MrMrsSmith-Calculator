<?php

namespace App\Model;

use App\Calculator\Calculatable;
use App\Calculator\OperatorList;

class Calculation
{
    private $operators = [];
    
    protected $variableA;
    protected $variableB;
    protected $operation;

    public function __construct(OperatorList $operators)
    {
        /**
         * @var string $name
         * @var \App\Calculator\Calculatable $operatorClass
         */
        foreach ($operators->get() as $name=>$operatorClass) {
            $this->operators[$operatorClass::getDisplayOperation()] = $name;
        }
    }

    public function getAvailableOperations(): array
    {
        return $this->operators;
    }

    public function getVariableA()
    {
        return $this->variableA;
    }

    public function setVariableA($variableA): void
    {
        $this->variableA = $variableA;
    }

    public function getVariableB()
    {
        return $this->variableB;
    }

    /**
     * @param mixed $variableB
     */
    public function setVariableB($variableB): void
    {
        $this->variableB = $variableB;
    }

    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * @param mixed $operation
     */
    public function setOperation($operation): void
    {
        $this->operation = $operation;
    }
}
