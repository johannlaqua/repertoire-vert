<?php

namespace App\Repository;

use App\Entity\EventFav;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EventFav|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventFav|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventFav[]    findAll()
 * @method EventFav[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventFavRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EventFav::class);
    }

    // /**
    //  * @return EventFav[] Returns an array of EventFav objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EventFav
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
