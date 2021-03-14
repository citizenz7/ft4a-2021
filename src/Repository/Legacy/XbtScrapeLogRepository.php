<?php

namespace App\Repository\Legacy;

use App\Entity\Legacy\XbtScrapeLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method XbtScrapeLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method XbtScrapeLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method XbtScrapeLog[]    findAll()
 * @method XbtScrapeLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class XbtScrapeLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, XbtScrapeLog::class);
    }

    // /**
    //  * @return XbtScrapeLog[] Returns an array of XbtScrapeLog objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('x')
            ->andWhere('x.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('x.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?XbtScrapeLog
    {
        return $this->createQueryBuilder('x')
            ->andWhere('x.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
