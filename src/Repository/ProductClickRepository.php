<?php

namespace App\Repository;

use App\Entity\ProductClick;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductClick|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductClick|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductClick[]    findAll()
 * @method ProductClick[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductClickRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductClick::class);
    }

    // /**
    //  * @return ProductClick[] Returns an array of ProductClick objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProductClick
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
