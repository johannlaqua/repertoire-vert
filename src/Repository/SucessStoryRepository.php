<?php

namespace App\Repository;

use App\Entity\SucessStory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SucessStory|null find($id, $lockMode = null, $lockVersion = null)
 * @method SucessStory|null findOneBy(array $criteria, array $orderBy = null)
 * @method SucessStory[]    findAll()
 * @method SucessStory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SucessStoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SucessStory::class);
    }

    // /**
    //  * @return SucessStory[] Returns an array of SucessStory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SucessStory
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
