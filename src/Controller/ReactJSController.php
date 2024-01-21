<?php

namespace App\Controller;

use App\Service\AppsService;
use App\Service\StackService;
use App\Service\ToolsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/react", name: "react_")]
class ReactJSController extends AbstractController
{
    #[Route("/api/stack", name: "api_stack")]
    public function stacks(StackService $service): JsonResponse
    {
        return $this->json(['stack' => $service->all()]);
    }

    #[Route("/api/apps/{stack}", name: "api_apps", methods: "GET")]
    public function apps(string $stack, AppsService $service): JsonResponse
    {
        return $this->json(['apps' => $service->findByCategory($stack)]);
    }

    #[Route("/api/tools/{app}", name: "api_tools", methods: "GET")]
    public function tools(string $app, ToolsService $service): JsonResponse
    {
        return $this->json(['tools' => $service->findByApp($app)]);
    }

    #[Route("/", name: "index")]
    #[Route("/{app}/{stack}", name: "route", defaults: ["app" => null, "stack" => null])]
    public function index(Request $request): Response
    {
        return $this->render(
            "react/index.html.twig"
        );
    }
}
