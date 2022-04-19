<?php

namespace App\Repository;

use App\Entity\CovInvitation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CovInvitation|null find($id, $lockMode = null, $lockVersion = null)
 * @method CovInvitation|null findOneBy(array $criteria, array $orderBy = null)
 * @method CovInvitation[]    findAll()
 * @method CovInvitation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CovInvitationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CovInvitation::class);
    }

    public function findByUserAndCovoiturage($userId, $covoiturageId)
    {
      return $this->createQueryBuilder('p')
        ->select("p")
        ->where('p.user = :userId')
        ->andWhere('p.covoiturage = :covoiturageId')
        ->leftJoin('p.friend', 'f')
        ->addSelect('partial f.{id, username, firstname, lastname}')
        ->leftJoin('p.user', 'u')
        ->addSelect('partial u.{id, username, firstname, lastname}')
        ->setParameter('userId', $userId)
        ->setParameter('covoiturageId', $covoiturageId)
        ->getQuery()
        ->getArrayResult();
    }

    // /**
    //  * @return CovInvitation[] Returns an array of CovInvitation objects
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
    public function findOneBySomeField($value): ?CovInvitation
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
