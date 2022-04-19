<?php

namespace App\Repository;

use App\Entity\Friendship;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Friendship|null find($id, $lockMode = null, $lockVersion = null)
 * @method Friendship|null findOneBy(array $criteria, array $orderBy = null)
 * @method Friendship[]    findAll()
 * @method Friendship[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FriendshipRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, Friendship::class);
  }

  public function findOneById(int $id): ?Friendship
  {
    return $this->createQueryBuilder('e')
      ->where('e.id = :id')
      ->setParameter('id', $id)
      ->getQuery()
      ->getOneOrNullResult();
  }

  public function findUserFriendships(int $id)
  {
    return $this->createQueryBuilder('e')
      ->where('e.user = :id')
      ->orWhere('e.friend = :id')
      ->leftJoin('e.user', 'u')
      ->addSelect('partial u.{id, firstname, lastname, username}')
      ->leftJoin('e.friend', 'f')
      ->addSelect('partial f.{id, firstname, lastname, username}')
      ->setParameter('id', $id)
      ->getQuery()
      ->getArrayResult();
  }
}
