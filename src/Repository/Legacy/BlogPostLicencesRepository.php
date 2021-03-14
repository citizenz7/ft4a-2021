<?php

namespace App\Repository\Legacy;

use App\Entity\Legacy\BlogPostLicences;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlogPostLicences|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogPostLicences|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogPostLicences[]    findAll()
 * @method BlogPostLicences[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogPostLicencesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogPostLicences::class);
    }

    // /**
    //  * @return BlogPostLicences[] Returns an array of BlogPostLicences objects
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
    public function findOneBySomeField($value): ?BlogPostLicences
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
