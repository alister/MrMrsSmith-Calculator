<?php

namespace App\Controller;

use App\Calculator\OperatorList;
use App\Form\CalcType;
use App\Model\Calculation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/calculator", name="calculator")
 */
class Calculator extends AbstractController
{
    /** @var \App\Calculator\OperatorList */
    private $operators;

    public function __construct(OperatorList $operators)
    {
        $this->operators = $operators;
    }

    public function __invoke(Request $request): Response
    {
        $result = null;
        
        $calc = new Calculation($this->operators);
        $form = $this->createForm(CalcType::class, $calc);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Calculation $calc */
            $calc = $form->getData();
            $result = [
                'variable_a' => $calc->getVariableA(),
                'operator' => $calc->getOperationByName(),
                'variable_b' => $calc->getVariableB(),
                'calculationResult' => $this->doCalculation($calc),
            ];
        }
        
        return $this->render(
            'calculator.html.twig', 
            [
                'form' => $form->createView(),
                'operators' => $this->operators,
                'result' => $result ?? [],
            ]
        );
    }

    private function doCalculation(Calculation $calculation)
    {
        $knownOperations = $this->operators->get();

        /**
         * @var string $operation
         * @var \App\Calculator\Calculatable $operationClass
         */
        foreach ($knownOperations as $operation=>$operationClass) {
            if ($operationClass->match($calculation->getOperation())) {
                return $operationClass->calculate([$calculation->getVariableA(), $calculation->getVariableB()]);
            }
        }
 
        throw new \RuntimeException('Unknown operation');
    }
}
