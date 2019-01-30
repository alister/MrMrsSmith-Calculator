<?php

namespace App\Controller;

use App\Calculator\OperatorList;
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
        return $this->render(
            'calculator.html.twig', 
            ['operators' => $this->operators]
        );
    }
}
