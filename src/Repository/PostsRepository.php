<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }
    public function findPostEntitiesByString($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a
                FROM App:Post a
                WHERE a.title LIKE :str'
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }

    public function findPostsWithCreator(): array
    {
      return $this->createQueryBuilder('post')
          ->select('post, count(s.id) as nbComments')
          ->leftJoin('post.creator', 'c')
          ->addSelect('partial c.{id, username}')
          ->leftJoin('post.comments', 's')
          ->addSelect('s.id')
          ->orderBy('post.createdAt', 'DESC')
          ->groupBy('post.id')
          ->getQuery()
          ->getArrayResult();
    }

    public function findPostByid($id)
    {
      return $this->createQueryBuilder('post')
          ->select('post')
          ->where('post.id = :id')
          ->leftJoin('post.creator', 'c') // Get post creator
          ->addSelect('partial c.{id, firstname, lastname, username}')
          ->leftJoin('post.comments', 's') // Get post comments
          ->addSelect('s')
          ->leftJoin('s.creator', 'sc') // Get post comments creator
          ->addSelect('partial sc.{id, firstname, lastname, username}')
          ->leftJoin('s.postCommentLikes', 'l') // Get post comment likes
          ->addSelect('l')
          ->leftJoin('l.creator', 'lc') // Get post comment like creator
          ->addSelect('partial lc.{id}')
          ->setParameter('id', $id)
          ->getQuery()
          ->getArrayResult();
    }

    public function TopEvent()
    {$query = $this->getEntityManager()
        ->createQuery("SELECT e FROM App:Post e 
         ORDER BY e.views DESC");
        return $result = $query->setMaxResults(5)->getResult();
    }

    public function FindAcceptedEv(){
        $query=$this->getEntityManager()
            ->createQuery("
            select e from App:Post e
            where e.approved=true");
        return $query->getResult();
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
