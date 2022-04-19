<?php

namespace App\Repository;

use App\Entity\CoupDeProjecteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CoupDeProjecteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoupDeProjecteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoupDeProjecteur[]    findAll()
 * @method CoupDeProjecteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoupDeProjecteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoupDeProjecteur::class);
    }

    // /**
    //  * @return CoupDeProjecteur[] Returns an array of CoupDeProjecteur objects
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
    public function findOneBySomeField($value): ?CoupDeProjecteur
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
