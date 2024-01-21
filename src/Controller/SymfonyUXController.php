<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\AppsService;
use App\Service\StackService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ux', name: 'ux_')]
class SymfonyUXController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(StackService $service): Response
    {
        return $this->render(
            'ux/stacks.html.twig',
            [
                "stacks" => $service->all(),
            ]
        );
    }

    #[Route('/stack', name: 'stack_index')]
    public function stack(AppsService $service): Response
    {
        return $this->render(
            'ux/stack.html.twig',
            [
            ]
        );
    }

    #[Route('/{stack}', name: 'stack')]
    public function getLang(string $stack, AppsService $service): Response
    {
        return $this->render(
            'ux/apps.html.twig',
            [
                'apps' => $service->findByCategory($stack),
            ]
        );
    }

    #[Route('/{stack}/{app}', name: 'tools')]
    public function getApp(string $stack, string $app, AppsService $service): Response
    {
        return $this->render(
            'ux/tools.html.twig',
            [
                'stack' => $service->getTechStack($app),
            ]
        );
    }
}
