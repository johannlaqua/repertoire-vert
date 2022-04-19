<?php

namespace App\Repository;

use App\Entity\Person;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Person|null find($id, $lockMode = null, $lockVersion = null)
 * @method Person|null findOneBy(array $criteria, array $orderBy = null)
 * @method Person[]    findAll()
 * @method Person[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, Person::class);
  }

  public function findOneById(int $id)
  {
    return $this->createQueryBuilder('e')
      //->select('partial e.{id, firstname, lastname, username, city, email, dateBirth, inscriptionDate}')
      ->select('e')
      ->where('e.id = :id')
      ->setParameter('id', $id)
      ->getQuery()
      ->getArrayResult();
  }


  public function findWithAllInfo(int $id) {
    return $this->createQueryBuilder('e')
      ->select('e')
      ->leftJoin('e.activities', 'a') // Get activities
      ->addSelect('a')
      ->leftJoin('a.activityType', 't') // Get activity types
      ->addSelect('t')
      ->leftJoin('e.carts', 'c') // Get orders
      ->addSelect('c')
      ->leftJoin('c.cartlines', 'l') // Get order products
      ->addSelect('l')
      ->leftJoin('l.produit', 'p') // Get product info
      ->addSelect('partial p.{id, name, image, origin}')
      ->leftJoin('e.covoiturages', 'v') // Get covoiturages
      ->addSelect('partial v.{id}')
      ->leftJoin('v.participations', 's') // Get covoiturage passengers
      ->addSelect('partial s.{id}')
      ->leftJoin('e.userPreferences', 'f') // Get user preferences
      ->addSelect('f')
      ->leftJoin('f.preference', 'n') // Get user preference name
      ->addSelect('n')
      //->leftJoin('App:Review', 'r',  'WITH', "r.entityId = e.id AND r.entityType = 'user'") // Get reviews
      //->addSelect('count(r) as totalReviews, SUM(r.value) as averageRating')
      //->addSelect('r')
      //->groupBy('v, s')
      //->addGroupBy('e.id')
      ->where('e.id = :id')
      ->orderBy('a.createdAt', 'DESC')
      ->addOrderBy('c.createdAt', 'DESC')
      ->setParameter('id', $id)
      ->getQuery()
      ->getArrayResult();
  }


  public function findAllPersons()
  {
    return $this->createQueryBuilder('e')
        ->select('e')
        ->getQuery()
        ->getArrayResult();
  }

  // /**
  //  * @return Company[] Returns an array of Company objects
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
    public function findOneBySomeField($value): ?Company
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
