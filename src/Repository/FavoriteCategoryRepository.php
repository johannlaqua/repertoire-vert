<?php

namespace App\Repository;

use App\Entity\FavoriteCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FavoriteCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method FavoriteCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method FavoriteCategory[]    findAll()
 * @method FavoriteCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavoriteCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FavoriteCategory::class);
    }

    public function findUserFavorites($userId)
    {
        return $this->createQueryBuilder('f')
            ->leftJoin('f.category', 'c')
            ->addSelect('partial c.{id, name, image, slug}')
            ->andWhere('f.user = :id')
            ->setParameter('id', $userId)
            ->orderBy('f.category', 'ASC')
            ->getQuery()
            ->getArrayResult()
        ;
    }

    // /**
    //  * @return FavoriteCategory[] Returns an array of FavoriteCategory objects
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
    public function findOneBySomeField($value): ?FavoriteCategory
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
