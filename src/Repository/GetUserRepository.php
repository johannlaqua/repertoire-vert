<?php

namespace App\Repository;

use App\Entity\GetUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GetUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method GetUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method GetUser[]    findAll()
 * @method GetUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GetUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GetUser::class);
    }

    // /**
    //  * @return GetUser[] Returns an array of GetUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GetUser
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
