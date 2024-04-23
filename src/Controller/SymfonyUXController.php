<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\FeaturesRepository;
use App\Service\AppsService;
use App\Service\StackService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Clock\ClockInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ux', name: 'ux_')]
class SymfonyUXController extends AbstractController
{
    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('ux/about.html.twig', []);
    }

    #[Route('/about/topic', name: 'about_topic')]
    public function aboutTopic(HubInterface $hub, ClockInterface $clock): Response
    {
        $now = $clock->now();
        while (true) {
            $hub->publish(
                new Update('topics', $this->renderView('ux/topic.stream.html.twig', []))
            );
            $clock->sleep(5);
            if ($clock->now()->getTimestamp() - $now->getTimestamp() >= 60) {
                break;
            }
        }

        return new Response();
    }

    #[Route('/features/recent', name: 'recent_features')]
    public function recentFeatures(FeaturesRepository $featuresRepository, HubInterface $hub): Response
    {
        $features = $featuresRepository->findAll();
        $feature = $features[0];
        
        return $this->render('ux/topic.stream.html.twig', ['feature' => $feature]);
    }


    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('ux/contact.html.twig', []);
    }

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
