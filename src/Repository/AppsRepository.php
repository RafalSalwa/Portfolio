<?php

namespace App\Repository;

use App\Entity\Application;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Application>
 *
 * @method Application|null find($id, $lockMode = null, $lockVersion = null)
 * @method Application|null findOneBy(array $criteria, array $orderBy = null)
 * @method Application[]    findAll()
 * @method Application[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Application::class);
    }

    public function getNameWithLang(): array
    {
        return $this->createQueryBuilder('a')
            ->select("concat('(',l.name,') ', a.name) AS name")
            ->join('a.lang', 'l')
            ->getQuery()
            ->getResult();
    }

    public function getLanguages()
    {
        return $this->createQueryBuilder('a')
            ->select('a.lang')
            ->orderBy('a.lang', 'ASC')
            ->distinct()
            ->getQuery()
            ->getResult();
    }

    public function getStack(string $app)
    {
    }

    public function findByName(string $app): ?Application
    {
        return $this->findOneBy(["name" => $app]);
    }
}
