<?php

namespace App\Controller;

use App\Calculator\OperatorList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/calculator", name="calculator")
 */
class Calculator extends AbstractController
{
    public function __construct(OperatorList $operators)
    {
        dd($operators);
        foreach ($operators as $operator) {
            dump($operator);
        }
    }

    public function __invoke()
    {
    }
}
