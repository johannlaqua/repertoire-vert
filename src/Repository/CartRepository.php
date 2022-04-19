<?php

namespace App\Repository;

use App\Entity\Cart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cart[]    findAll()
 * @method Cart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cart::class);
    }

    public function findCurrentUserCartWithInfo($id)
    {
        return $this->createQueryBuilder('c')
            ->select('c, l')
            ->andWhere('c.creator = :id')
            ->andWhere("c.status = 'current'")
            ->leftJoin('c.cartlines', 'l')
            ->leftJoin('l.produit', 'p')
            ->addSelect('partial p.{id, name, image, price, currency}')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();
    }


    public function findCurrentUserCart($id)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.creator = :id')
            ->andWhere("c.status = 'current'")
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }


    /**
     * @return Cart[] Returns an array of Cart objects
     */
    public function findUserOrders($id)
    {
        return $this->createQueryBuilder('c')
            ->select('c')
            ->leftJoin('c.cartlines', 'l')
            ->addSelect('l')
            ->leftJoin('l.produit', 'p')
            ->addSelect('partial p.{id, name, price, currency, image}')
            ->andWhere('c.creator = :id')
            ->andWhere("c.status != 'current'")
            ->setParameter('id', $id)
            ->orderBy('c.createdAt', 'DESC')
            ->getQuery()
            ->getArrayResult()
        ;
    }
    

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