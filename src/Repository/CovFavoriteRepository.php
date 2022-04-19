<?php

namespace App\Repository;

use App\Entity\CovFavorite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CovFavorite|null find($id, $lockMode = null, $lockVersion = null)
 * @method CovFavorite|null findOneBy(array $criteria, array $orderBy = null)
 * @method CovFavorite[]    findAll()
 * @method CovFavorite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CovFavoriteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CovFavorite::class);
    }

    public function findByUser($userId)
    {
      return $this->createQueryBuilder('p')
        ->select("p")
        ->where('p.user = :userId')
        ->leftJoin('p.favorite', 'f')
        ->addSelect('partial f.{id, username, firstname, lastname}')
        ->setParameter('userId', $userId)
        ->getQuery()
        ->getArrayResult();
    }

    // /**
    //  * @return CovFavorite[] Returns an array of CovFavorite objects
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
    public function findOneBySomeField($value): ?CovFavorite
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
