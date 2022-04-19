<?php

namespace App\Repository;

use App\Entity\Ads;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ads|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ads|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ads[]    findAll()
 * @method Ads[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ads::class);
    }



    public function FindPayedAds(){

        $query=$this->getEntityManager()
            ->createQuery("
            select e from App:Ads e
            where e.payed=true 
            ");
        return $query->getArrayResult();
    }

    public function FindAllAds(){

        $query = $this->getEntityManager()
            ->createQueryBuilder('p')
            ->select("p, c")
            ->leftJoin('p.location', 'c')
            ->getQuery()
            ->getArrayResult();
        return $query;
        /*
        return $this->createQueryBuilder('p')
        ->andWhere('p.company = :idcomp')
        ->setParameter('idcomp', $idcomp)
        ->getQuery()
        ->getResult()
        ;*/
    }

    public function FindNonAcceptedEv(){
        $query=$this->getEntityManager()
            ->createQuery("select e from App:Post e where e.approved=false");

        return $query->getResult();
    }

    public function FindByName($motcle){
        $query=$this->getEntityManager()
            ->createQuery("
            select e from App:Post e
            where e.title like :motcle")
            ->setParameter('motcle',$motcle.'%');
        return $query->getResult();
    }
}
