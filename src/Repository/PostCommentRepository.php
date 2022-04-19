<?php

namespace App\Repository;

use App\Entity\PostComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PostComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostComment[]    findAll()
 * @method PostComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostCommentRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, PostComment::class);
  }

  public function findOneById(int $id): ?PostComment
  {
    return $this->createQueryBuilder('e')
      ->where('e.id = :id')
      ->setParameter('id', $id)
      ->getQuery()
      ->getOneOrNullResult();
  }

  public function findByPostId(int $id)
  {
    return $this->createQueryBuilder('c')
        ->select('c, p.id AS creatorId, p.username')
        ->where('c.post = :id')
        ->leftJoin('App:Person', 'p', 'WITH', 'p.id = c.creator')
        ->setParameter('id', $id)
        ->getQuery()
        ->getArrayResult();
  }

  public function findByPostIdWithLikes(int $id)
  {
    return $this->createQueryBuilder('c')
        ->select('c, p.id AS creatorId, p.username')
        ->where('c.post = :id')
        ->leftJoin('App:Person', 'p', 'WITH', 'p.id = c.creator')
        ->leftJoin('c.postCommentLikes', 'l')
        ->leftJoin('l.creator', 'u')
        ->addSelect('l','partial u.{id}')
        ->setParameter('id', $id)
        ->getQuery()
        ->getArrayResult();
  }

  // /**
  //  * @return Category[] Returns an array of Category objects
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
    public function findOneBySomeField($value): ?Category
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