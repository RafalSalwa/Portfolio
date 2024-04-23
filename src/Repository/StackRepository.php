<?php

namespace App\Repository;

use App\Entity\Stack;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Stack>
 *
 * @method Stack|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stack|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stack[]    findAll()
 * @method Stack[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stack::class);
    }

    public function findAllAsArray()
    {
        return $this->createQueryBuilder('l')
            ->getQuery()
            ->getResult(AbstractQuery::HYDRATE_ARRAY);
    }

    public function all()
    {
        return $this->createQueryBuilder('l')
            ->getQuery()
            ->getResult();
    }
}
