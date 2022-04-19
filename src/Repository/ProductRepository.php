<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\AST\Join;


/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, Product::class);
  }
  public function searchProductAdvanced()
  {
    $param = 0;
    $qb = $this->createQueryBuilder('p');

    // Récupération de tout les produits 
    $qb->where('p.id >= :val')
      ->setParameter('val', '1');

    $query = $qb->getQuery();

    return $query->execute();
  }

  public function findOneByid($id) {
    return $this->createQueryBuilder('p')
      ->select('p, partial c.{id, name}, partial s.{id, name, image}, partial sc.{id, name}')
      ->leftJoin('p.company', 'c')
      ->leftJoin('p.subcategories', 's')
      ->leftJoin('s.categories', 'sc')
      ->andWhere('p.id = :id')
      ->setParameter('id', $id)
      ->getQuery()
      ->getArrayResult();
  }

  public function findAllProductsByComp($idcomp)
  {
    return $this->createQueryBuilder('p')
      ->andWhere('p.company = :idcomp')
      ->setParameter('idcomp', $idcomp)
      ->getQuery()
      ->getResult();
  }


  public function getCompanyProductsAverageRatingByRole($companyId, $role) {
    return $this->createQueryBuilder('p')
          ->select('partial p.{id, name} as product, partial c.{id, name}')
          ->leftJoin('p.company', 'c')
          ->leftJoin('App:Review', 'r',  'WITH', 'r.entityId = p.id')
          ->leftJoin('r.owner', 'o')
          ->addSelect('count(r) as total, AVG(r.value) as average, o')
          ->andWhere('c.id = :companyId')
          ->andWhere('o.role = :role')
          ->setParameter('companyId', $companyId)
          ->setParameter('role', $role)
          ->groupBy('r.entityId')
          ->getQuery()
          ->getArrayResult()
      ;
  }

  public function findLatestProducts($date)
  {
    return $this->createQueryBuilder('e')
      ->select('partial e.{id, name, price, currency, image, creationdate}')
      ->leftJoin('e.subcategories', 's')
      ->addSelect('partial s.{id}')
      ->leftJoin('s.categories', 'c')
      ->addSelect('partial c.{id, name}')
      ->andWhere('e.creationdate >= :date')
      ->orderBy('e.creationdate', 'DESC')
      ->groupBy('e')
      //->setMaxResults(5)
      ->setParameter('date', $date)
      ->getQuery()
      ->getArrayResult();
  }

  public function findProductsByDate($date)
  {
    return $this->createQueryBuilder('e')
      ->select('partial e.{id, name, price, currency, image, creationdate}')
      ->andWhere('e.creationdate >= :date')
      ->orderBy('e.creationdate', 'DESC')
      ->setParameter('date', $date)
      ->getQuery()
      ->getArrayResult();
  }


  public function findProductsToday()
  {
    return $this->createQueryBuilder('p')
      ->andWhere('CURRENT_DATE() = p.creationdate ')
      ->orderBy('p.creationdate', 'DESC')
      ->setMaxResults(3)
      ->getQuery()
      ->getResult();
  }

  public function findProductsThisMonth()
  {
    $year = date("y");
    $month = date("m");
    $fromTime = new \DateTime($year . '-' . $month . '-00');
    return $this->createQueryBuilder('p')
      ->andWhere('p.creationdate > :val')
      ->setParameter('val', $fromTime)
      ->orderBy('p.creationdate', 'DESC')
      ->getQuery()
      ->getResult();
  }

  public function findProductsSince($old_date)
  {
    $year = $old_date->format("y");
    $month = $old_date->format("m");
    $fromTime = new \DateTime($year . '-' . $month . '-00');

    return $this->createQueryBuilder('p')
      ->andWhere('p.creationdate >= :date')
      ->setParameter('date', $fromTime)
      ->orderBy('p.creationdate', 'DESC')
      ->getQuery()
      ->getResult();
  }

  public function findProductsThisWeek()
  {
    $fromTime = new \DateTime();
    $q = $fromTime->format('y-m-d');
    $date = strtotime($q);
    $n = date('W', $date);
    return $this->createQueryBuilder('p')
      ->andWhere('WEEK(p.creationdate) = :val')
      ->setParameter('val', $n)
      ->orderBy('p.creationdate', 'DESC')
      ->getQuery()
      ->getResult();
  }

  // /**
  //  * @return Product[] Returns an array of Product objects
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
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


  public function findEntitiesByString($str)
  {
    return $this->getEntityManager()
      ->createQuery(
        'SELECT a
                FROM App:Product a
                WHERE a.name LIKE :str'
      )
      ->setParameter('str', '%' . $str . '%')
      ->getResult();
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

  public function findProductByid($id)
  {
    return $this->getEntityManager()
      ->createQuery(
        "SELECT a
       FROM App:Product
       a WHERE a.id = :id"
      )
      ->setParameter('id', $id)
      ->getOneOrNullResult();
  }

  public function TopEvent()
  {
    $query = $this->getEntityManager()
      ->createQuery("SELECT e FROM App:Product e 
         ORDER BY e.views DESC");
    return $result = $query->setMaxResults(5)->getResult();
  }



  /*    $query = $this
                ->createQueryBuilder('p')
                ->select('c', 'p')
                ->join('p.categories', 'c');
            if(!empty($search->q)){
            $query = $query
                ->andWhere('p.name LIKE :q')
                ->setParameter('q', "%{$search->q}%");
            }
            if(!empty($search->min)){
            $query = $query
                ->andWhere('p.price >= :min')
                ->setParameter('min', $search->min);
            }
            if(!empty($search->max)){
            $query = $query
                ->andWhere('p.price <= :max')
                ->setParameter('max', $search->max);
            }
            if(!empty($search->promo)){
            $query = $query
                ->andWhere('p.promo = 1');
            }
            if(!empty($search->categories)){
            $query = $query
                ->andWhere('c.id IN ( :categories)')
                ->setParameter('categories', $search->categories);
            }*/

  //$query = $query->getQuery();





}
