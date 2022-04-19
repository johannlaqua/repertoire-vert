<?php

namespace App\Repository;

use App\Entity\Company;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use stdClass;

/**
 * @method Company|null find($id, $lockMode = null, $lockVersion = null)
 * @method Company|null findOneBy(array $criteria, array $orderBy = null)
 * @method Company[]    findAll()
 * @method Company[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyRepository extends ServiceEntityRepository
{

  private $logger;

  public function __construct(
    ManagerRegistry $registry,
    LoggerInterface $logger)
  {
    parent::__construct($registry, Company::class);
    $this->logger = $logger;
  }

  public function search_all_companies()
  {
    $param = 0;
    $qb = $this->createQueryBuilder('c');

    // Récupération de toutes les entreprises
    $qb->where('c.id >= :val')
      ->setParameter('val', '1');

    $query = $qb->getQuery();

    return $query->execute();
  }


  public function getCompanyWithCategoriesAndProducts($id)
  {
    return $this->createQueryBuilder('p')
      ->select('p')
      ->where('p.id = :id')
      ->leftJoin('p.categories', 'c')
      ->addSelect('partial c.{id, name}')
      ->leftJoin('p.products', 'd')
      ->addSelect('d')
      ->setParameter('id', $id)
      ->getQuery()
      ->getArrayResult();
  }
  

  public function getCompaniesByCatAndSubcat($catId, $subcatId)
  {
    return $this->createQueryBuilder('c')
      ->where('c.activated = 1')
      ->join('c.categories', 'ca')
      ->andWhere('ca.id = :catId')
      ->join('ca.subcategories', 's')
      ->andWhere('s.id = :subcatId ')
      ->join('s.products', 'p')
      ->setParameters(['subcatId' => $subcatId, 'catId' => $catId])
      ->orderBy('c.niveau', 'DESC')
      ->getQuery();
    //->getResult();
  }

  public function findLatestCompanies($date)
  {
    return $this->createQueryBuilder('e')
      ->select('partial e.{id, name, image, inscriptiondate}')
      ->leftJoin('e.categories', 'c')
      ->addSelect('partial c.{id, name, image}')
      ->andWhere('e.inscriptiondate >= :date')
      ->orderBy('e.inscriptiondate', 'DESC')
      //->groupBy('e.id')
      //->setMaxResults(20)
      ->setParameter('date', $date)
      ->getQuery()
      ->getArrayResult();

      /*$paginator = new Paginator($query, $fetchJoinCollection = true);

      $array = [];

      foreach ($paginator as $c) {
        $company = new stdClass();
        $company->id = $c->getId();
        $company->name = $c->getName();
        $company->image = $c->getImage();
        $company-> inscriptiondate = $c->getInscriptiondate()->format(DateTime::ATOM);
        $company->categories = $c->categories;
        $array[] = (object) $company;
      }

      return $array;*/
  }

  public function findCompaniesByDate($date)
  {
    return $this->createQueryBuilder('e')
      ->select('partial e.{id, name, image, inscriptiondate}')
      ->andWhere('e.inscriptiondate >= :date')
      ->orderBy('e.inscriptiondate', 'DESC')
      ->setParameter('date', $date)
      ->getQuery()
      ->getArrayResult();
  }

  public function findCompaniesToday()
  {
    return $this->createQueryBuilder('e')
      ->andWhere('CURRENT_DATE() = e.inscriptiondate ')
      ->orderBy('e.inscriptiondate', 'DESC')
      ->setMaxResults(3)
      ->getQuery()
      ->getResult();
  }

  public function findCompaniesThisMonth()
  {
    $year = date("y");
    $month = date("m");
    $fromTime = new \DateTime($year . '-' . $month . '-00');
    return $this->createQueryBuilder('e')
      ->andWhere('e.inscriptiondate > :val')
      ->setParameter('val', $fromTime)
      ->orderBy('e.inscriptiondate', 'DESC')
      ->getQuery()
      ->getResult();
  }

  public function findCompaniesSince($old_date)
  {
    $year = $old_date->format("y");
    $month = $old_date->format("m");
    $fromTime = new \DateTime($year . '-' . $month . '-00');

    return $this->createQueryBuilder('c')
      ->andWhere('c.inscriptiondate >= :date')
      ->setParameter('date', $fromTime)
      ->orderBy('c.inscriptiondate', 'DESC')
      ->getQuery()
      ->getResult();
  }

  public function findCompaniesThisWeek()
  {
    $fromTime = new \DateTime();
    $q = $fromTime->format('y-m-d');
    $date = strtotime($q);
    $n = date('W', $date);
    return $this->createQueryBuilder('e')
      ->andWhere('WEEK(e.inscriptiondate) = :val')
      ->setParameter('val', $n)
      ->orderBy('e.inscriptiondate', 'DESC')
      ->getQuery()
      ->getResult();
  }
}
