<?php

namespace App\Controller;

use App\Calculator\OperatorList;
use App\Form\CalcType;
use App\Model\Calculation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        #dd($operators);
        #foreach ($operators as $operator) {
        #    dump($operator);
        #}
        $this->operators = $operators;
    }

    public function __invoke(): Response
    {
        $calc = new Calculation($this->operators);
        $form = $this->createForm(CalcType::class, $calc);

        return $this->render(
            'calculator.html.twig', 
            [
                'form' => $form->createView(),
                'operators' => $this->operators
            ]
        );
    }
}
