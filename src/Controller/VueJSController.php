<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/vue", name:"vue_")]
class VueJSController extends AbstractController
{
    #[Route("/", name:"index")]
    public function index():Response
    {
        return $this->render("vue/index.html.twig"

        );
    }
}