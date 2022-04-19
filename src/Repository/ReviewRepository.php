<?php

namespace App\Repository;

use App\Entity\Review;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Review|null find($id, $lockMode = null, $lockVersion = null)
 * @method Review|null findOneBy(array $criteria, array $orderBy = null)
 * @method Review[]    findAll()
 * @method Review[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }
    

    public function findByEntityId($id, $type)
    {
        return $this->createQueryBuilder('r')
            ->select('r', 'partial o.{id, username}')
            ->leftJoin('r.owner', 'o')
            ->andWhere('r.entityType = :type')
            ->andWhere('r.entityId = :id')
            ->setParameter('id', $id)
            ->setParameter('type', $type)
            ->orderBy('r.createdAt', 'DESC')
            ->getQuery()
            ->getArrayResult()
        ;
    }


    public function findById($id, $type, $role)
    {
        return $this->createQueryBuilder('r')
            ->select('r', 'partial o.{id, username, firstname, lastname, role}')
            ->leftJoin('r.owner', 'o')
            ->andWhere('r.entityType = :type')
            ->andWhere('r.entityId = :id')
            ->andWhere('o.role = :role')
            ->setParameter('id', $id)
            ->setParameter('type', $type)
            ->setParameter('role', $role)
            ->orderBy('r.createdAt', 'DESC')
            ->getQuery()
            ->getArrayResult()
        ;
    }


    public function getAverageRating($id, $type) {
      return $this->createQueryBuilder('r')
            ->select('count(r) as total, AVG(r.value) as average')
            ->andWhere('r.entityType = :type')
            ->andWhere('r.entityId = :id')
            ->setParameter('id', $id)
            ->setParameter('type', $type)
            ->groupBy('r.entityId')
            ->getQuery()
            ->getResult()
        ;
    }


    public function getAverageRatingByRole($id, $type, $role) {
      return $this->createQueryBuilder('r')
            ->select('count(r) as total, AVG(r.value) as average')
            ->leftJoin('r.owner', 'o')
            ->andWhere('r.entityType = :type')
            ->andWhere('r.entityId = :id')
            ->andWhere('o.role = :role')
            ->setParameter('id', $id)
            ->setParameter('type', $type)
            ->setParameter('role', $role)
            ->groupBy('r.entityId')
            ->getQuery()
            ->getArrayResult()
        ;
    }


    public function deleteProductReviews($id) {
      $this->createQueryBuilder('r')
          ->delete()
          ->where('r.entityId = :id')
          ->andWhere("r.entityType = 'product'")
          ->setParameter('id', $id)
          ->getQuery()
          ->execute();
    }


    // /**
    //  * @return ReportType[] Returns an array of ReportType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReportType
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
