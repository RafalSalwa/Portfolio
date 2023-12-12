<?php

namespace App\Repository;

use App\Entity\TechTags;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TechTags>
 *
 * @method TechTags|null find($id, $lockMode = null, $lockVersion = null)
 * @method TechTags|null findOneBy(array $criteria, array $orderBy = null)
 * @method TechTags[]    findAll()
 * @method TechTags[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TechTagsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TechTags::class);
    }

//    /**
//     * @return TechTags[] Returns an array of TechTags objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TechTags
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
