<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function findSixPassedEvents($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.startingDate < :val')
            ->setParameter('val', $value)
            ->orderBy('e.startingDate', 'DESC')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findSixComingEvents($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.startingDate > :val')
            ->setParameter('val', $value)
            ->orderBy('e.startingDate', 'ASC')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult()
            ;
    }


    // /**
    //  * @return Event[] Returns an array of Event objects
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
    public function findOneBySomeField($value): ?Event
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function searchEventAdvanced($criteria)
    {

        return $this->createQueryBuilder('c')


            ->andWhere('c.name LIKE :nom')
            ->setParameter('nom', '%' . $criteria['nom'] . '%' )
            ->andWhere('c.place LIKE :lieu')
            ->setParameter('lieu', '%' . $criteria['lieu'] . '%' )
            ->andWhere('c.startingDate LIKE :mois')
            ->setParameter('mois', '%' . $criteria['mois'] . '%' )
            ->andWhere('c.startingDate LIKE :annee')
            ->setParameter('annee', '%' . $criteria['annee'] . '%' )

            ->getQuery()
            ->getResult()
            ;
    }
}
