<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/ux", name:"ux_")]
class SymfonyUXController extends AbstractController
{
    #[Route("/", name:"index")]
    public function index():Response
    {
        return $this->render("ux/index.html.twig"

        );
    }
    #[Route("/golang", name:"golang")]
    public function getGolang():Response
    {
        return $this->render("ux/golang.html.twig"

        );
    }
}