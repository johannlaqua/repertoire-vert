<?php

namespace App\Repository;

use App\Entity\CompanyFavoris;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompanyFavoris|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyFavoris|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyFavoris[]    findAll()
 * @method CompanyFavoris[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyFavorisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyFavoris::class);
    }

    // /**
    //  * @return CompanyFavoris[] Returns an array of CompanyFavoris objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CompanyFavoris
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
