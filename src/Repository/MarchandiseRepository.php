<?php

namespace App\Repository;

use App\Entity\Marchandise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method Marchandise|null find($id, $lockMode = null, $lockVersion = null)
 * @method Marchandise|null findOneBy(array $criteria, array $orderBy = null)
 * @method Marchandise[]    findAll()
 * @method Marchandise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarchandiseRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, Marchandise::class);
  }

}
