<?php

namespace App\Command;

use App\Repository\FeaturesRepository;
use Symfony\Component\Clock\ClockInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

#[AsCommand(name: 'app:mercure-publish-tools')]
class PublishToolsListCommand extends Command
{
    public function __construct(
        private readonly HubInterface $hub,
        private readonly ClockInterface $clock,
        private readonly FeaturesRepository $featuresRepository,
        private Environment $twig
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Publish updates to mercure hub');
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $now = $this->clock->now();
        $features = $this->featuresRepository->findAll();

        foreach ($features as $feature) {
            $this->hub->publish(
                new Update('topics', $this->twig->render('ux/topic.stream.html.twig', ['feature' => $feature]))
            );
            $this->clock->sleep(6);
            if ($this->clock->now()->getTimestamp() - $now->getTimestamp() >= 55) {
                break;
            }
        }

        return Command::SUCCESS;
    }
}
