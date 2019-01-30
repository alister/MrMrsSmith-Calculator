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
            dump($form->getData());
            /** @var Calculation $calc */
            $calc = $form->getData();
            $result = [
                'variable_a' => $calc->getVariableA(),
                'operator' => $calc->getOperationByName(),
                'variable_b' => $calc->getVariableB(),
                'calculationResult' => $calc->getVariableA() + $calc->getVariableB(),
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
}
