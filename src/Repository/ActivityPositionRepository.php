<?php

namespace App\Repository;

use App\Entity\ActivityPosition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ActivityPosition|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActivityPosition|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActivityPosition[]    findAll()
 * @method ActivityPosition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivityPositionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActivityPosition::class);
    }

    // /**
    //  * @return ActivityPosition[] Returns an array of ActivityPosition objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ActivityPosition
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
