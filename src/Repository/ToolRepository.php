<?php

namespace App\Repository;

use App\Entity\Application;
use App\Entity\Tool;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tool>
 *
 * @method Tool|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tool|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tool[]    findAll()
 * @method Tool[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ToolRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tool::class);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function getFor(Application $app)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.application = :app')
            ->setParameter('app', $app)
            ->orderBy('t.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

}
