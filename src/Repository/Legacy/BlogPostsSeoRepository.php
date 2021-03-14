<?php

namespace App\Repository\Legacy;

use App\Entity\Legacy\BlogPostsSeo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlogPostsSeo|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogPostsSeo|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogPostsSeo[]    findAll()
 * @method BlogPostsSeo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogPostsSeoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogPostsSeo::class);
    }

    // /**
    //  * @return BlogPostsSeo[] Returns an array of BlogPostsSeo objects
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
    public function findOneBySomeField($value): ?BlogPostsSeo
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
