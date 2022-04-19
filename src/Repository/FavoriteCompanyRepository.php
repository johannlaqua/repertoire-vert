<?php

namespace App\Repository;

use App\Entity\FavoriteCompany;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FavoriteCompany|null find($id, $lockMode = null, $lockVersion = null)
 * @method FavoriteCompany|null findOneBy(array $criteria, array $orderBy = null)
 * @method FavoriteCompany[]    findAll()
 * @method FavoriteCompany[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavoriteCompanyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FavoriteCompany::class);
    }

    public function findUserFavorites($userId)
    {
        return $this->createQueryBuilder('f')
            ->leftJoin('f.company', 'c')
            ->addSelect('partial c.{id, name, image}')
            ->andWhere('f.user = :id')
            ->setParameter('id', $userId)
            ->getQuery()
            ->getArrayResult()
        ;
    }

    // /**
    //  * @return FavoriteCcompany[] Returns an array of FavoriteCompany objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FavoriteCompany
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
