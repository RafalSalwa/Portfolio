<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\Cache;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index', defaults: ['_format' => 'html',], methods: ['GET'])]
    #[Cache(public: true, maxage: 3600, mustRevalidate: true)]
    public function index(): Response
    {
        return $this->render('index/index.html.twig');
    }
}
