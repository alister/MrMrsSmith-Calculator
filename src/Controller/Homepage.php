<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Mostly a controller to show what I would do if this were more complex.
 * 
 * A normal homepage could often just be driven right out of the routing with a 
 * default page if it didn't need (much) dynamic content
 *
 * # routing.yml  
 * homepage:
 *     path:  /
 *     controller: Symfony\Bundle\FrameworkBundle\Controller\TemplateController
 *     defaults:
 *         template: 'Default/homepage.html.twig'
 * Or, as in this instance, an in-routing.yml redirect.
 * 
 * @Route("/")
 */
class Homepage extends AbstractController
{
    public function __invoke()
    {
        return $this->redirectToRoute('calculator', []);
    }
}
