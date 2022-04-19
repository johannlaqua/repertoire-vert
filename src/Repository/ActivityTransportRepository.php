<?php

namespace App\Repository;

use App\Entity\ActivityTransport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ActivityTransport|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActivityTransport|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActivityTransport[]    findAll()
 * @method ActivityTransport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivityTransportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActivityTransport::class);
    }

    // /**
    //  * @return ActivityTransport[] Returns an array of ActivityTransport objects
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
    public function findOneBySomeField($value): ?ActivityTransport
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
