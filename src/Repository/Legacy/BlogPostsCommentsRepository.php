<?php

namespace App\Repository\Legacy;

use App\Entity\Legacy\BlogPostsComments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlogPostsComments|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogPostsComments|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogPostsComments[]    findAll()
 * @method BlogPostsComments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogPostsCommentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogPostsComments::class);
    }

    // /**
    //  * @return BlogPostsComments[] Returns an array of BlogPostsComments objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BlogPostsComments
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
