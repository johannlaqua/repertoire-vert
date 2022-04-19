<?php

namespace App\Repository;

use App\Entity\Invention;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Invention|null find($id, $lockMode = null, $lockVersion = null)
 * @method Invention|null findOneBy(array $criteria, array $orderBy = null)
 * @method Invention[]    findAll()
 * @method Invention[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InventionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Invention::class);
    }

    // /**
    //  * @return Invention[] Returns an array of Invention objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Invention
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
