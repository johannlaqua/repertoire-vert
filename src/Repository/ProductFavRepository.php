<?php

namespace App\Repository;

use App\Entity\ProductFav;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductFav|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductFav|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductFav[]    findAll()
 * @method ProductFav[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductFavRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, ProductFav::class);
  }

  public function findAllByUserId(int $userId): array
  {
    return $this->createQueryBuilder('f')
      ->select('f, p')
      ->leftJoin('f.product', 'p')
      ->where('f.user = :userId')
      ->setParameter('userId', $userId)
      ->getQuery()
      ->getArrayResult();
  }

  public function findOneByUserIdAndProductId(int $userId, int $productId): ?ProductFav
  {
    return $this->createQueryBuilder('e')
      ->where('e.user = :userId')
      ->andWhere('e.product = :productId')
      ->setParameter('userId', $userId)
      ->setParameter('productId', $productId)
      ->getQuery()
      ->getOneOrNullResult();
  }

  // /**
  //  * @return ProductFav[] Returns an array of ProductFav objects
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
    public function findOneBySomeField($value): ?ProductFav
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
