<?php

namespace App\Repository;

use App\Entity\Communauty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CateCommunautygory|null find($id, $lockMode = null, $lockVersion = null)
 * @method Communauty|null findOneBy(array $criteria, array $orderBy = null)
 * @method Communauty[]    findAll()
 * @method Communauty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommunautyRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, Communauty::class);
  }

  public function findOneById(int $id): ?Communauty
  {
    return $this->createQueryBuilder('e')
      ->where('e.id = :id')
      ->setParameter('id', $id)
      ->getQuery()
      ->getOneOrNullResult();
  }

  public function findAllWithCreator()
  {
    return $this->createQueryBuilder('e')
      ->select('e')
      ->leftJoin('e.createur', 'c')
      ->addSelect('e', 'partial c.{id, firstname, lastname}')
      ->getQuery()
      ->getArrayResult();
  }

  public function findMatching(string $date) {
    return $this->createQueryBuilder('p')
      ->where('p.departuredate LIKE :departuredate')
      ->select("p")
      ->leftJoin('p.createur', 'c')
      ->addSelect('partial c.{id, username, firstname, lastname}')
      ->setParameter('departuredate', $date)
      ->orderBy('p.departuredate')
      ->getQuery()
      ->getArrayResult();
  }

  public function findWithRelationships(int $id)
  {
    return $this->createQueryBuilder('e')
      ->where('e.id = :id')
      ->leftJoin('e.createur', 'c')
      ->addSelect('partial c.{id, firstname, lastname}')
      ->leftJoin('e.participations', 'p')
      ->leftJoin('p.participant', 'u')
      ->addSelect('p, partial u.{id, username, firstname, lastname}')
      ->leftJoin('e.invitations', 'i')
      ->leftJoin('i.friend', 'f')
      ->leftJoin('i.user', 's')
      ->addSelect('i, partial f.{id, username, firstname, lastname}, 
        partial s.{id, username, firstname, lastname}')
      ->setParameter('id', $id)
      ->getQuery()
      ->getArrayResult();
  }

  // /**
  //  * @return Communauty[] Returns an array of Communauty objects
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
    public function findOneBySomeField($value): ?Communauty
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
