<?php

namespace App\Repository;

use App\Entity\CompanyFav;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompanyFav|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyFav|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyFav[]    findAll()
 * @method CompanyFav[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyFavRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyFav::class);
    }

    // /**
    //  * @return CompanyFav[] Returns an array of CompanyFav objects
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
    public function findOneBySomeField($value): ?CompanyFav
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findByPeriode(\Datetime $from, \Datetime $to)
    {
        $from->format("Y-m-d")." 00:00:00";
        $to->format("Y-m-d")." 23:59:59";

        $qb = $this->createQueryBuilder("e");
        $qb
            ->andWhere('e.date BETWEEN :from AND :to')
            ->setParameter('from', $from )
            ->setParameter('to', $to)
        ;
        $result = $qb->getQuery()->getResult();

        return $result;
    }

     /**
      * @return CompanyFav[] Returns an array of CompanyFav objects
      */
    public function findByCompany($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.company = :val')
            ->setParameter('val', $value)
            ->orderBy('c.date', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
}
