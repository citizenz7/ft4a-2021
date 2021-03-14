<?php

namespace App\Repository\Legacy;

use App\Entity\Legacy\BlogLogs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlogLogs|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogLogs|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogLogs[]    findAll()
 * @method BlogLogs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogLogsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogLogs::class);
    }

    // /**
    //  * @return BlogLogs[] Returns an array of BlogLogs objects
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
    public function findOneBySomeField($value): ?BlogLogs
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
