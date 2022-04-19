<?php

namespace App\Repository;

use App\Entity\Subcategory;
use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\AST\Join;


/**
 * @method Subcategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subcategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subcategory[]    findAll()
 * @method Subcategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubcategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subcategory::class);
    }

    public function findByCompany($company)
    {
        return $this->createQueryBuilder('s')
            //->where('c.activated = 1')
            ->join('s.products', 'p')
            ->join('p.company', 'c')
            ->where('c.id = :companyId')
            ->join('c.categories', 'ca')
            ->setParameter('companyId', $company)
            ->getQuery()
            ->getResult();
    }

    public function findById($id)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult()
        ;
    }

    public function findWithProducts($id)
    {
        return $this->createQueryBuilder('s')
            ->select('s', 'partial p.{id, name}', 'ps', 'partial sc.{id, name}', 'c', 'partial cp.{id, name}', 'partial a.{id, name, image}')
            ->andWhere('s.id = :id')
            ->leftJoin('s.products', 'p')
            ->leftJoin('p.subcategories', 'ps')
            ->leftJoin('ps.categories', 'sc')
            ->leftJoin('p.company', 'c')
            ->leftJoin('c.products', 'cp')
            ->leftJoin('c.categories', 'a')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult()
        ;
    }

    // /**
    //  * @return Subcategory[] Returns an array of Subcategory objects
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
    public function findOneBySomeField($value): ?Cartline
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