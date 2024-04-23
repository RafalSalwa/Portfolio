<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\AppsRepository;
use App\Repository\StackRepository;
use App\Repository\ToolRepository;
use Doctrine\ORM\NonUniqueResultException;

readonly class AppsService
{
    public function __construct(
        private AppsRepository $appsRepository,
        private StackRepository $stackRepository,
        private ToolRepository $stackItemRepository,
    ) {
    }

    /**
     * @throws NonUniqueResultException
     */
    public function getTechStack(string $appName)
    {
        $app = $this->appsRepository->findByName($appName);

        return $this->stackItemRepository->getFor($app);
    }

    public function findByCategory(string $stack)
    {
        $stackId = $this->stackRepository->findOneBy(['name' => $stack]);

        return $this->appsRepository->findBy(['lang' => $stackId]);
    }
}
