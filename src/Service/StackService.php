<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\StackRepository;

readonly class StackService
{
    public function __construct(
        private StackRepository $stackRepository
    ) {
    }

    public function getTechStack(string $appName)
    {
    }

    public function all(): array
    {
        return $this->stackRepository->all();
    }

    public function allAsArray()
    {
        return $this->stackRepository->findAllAsArray();
    }
}
