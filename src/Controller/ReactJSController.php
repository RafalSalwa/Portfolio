<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/react", name:"react_")]
class ReactJSController extends AbstractController
{
    #[Route("/", name:"index")]
    public function index():Response
    {
        return $this->render("react/index.html.twig"

        );
    }
}