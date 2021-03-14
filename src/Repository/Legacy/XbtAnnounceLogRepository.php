<?php

namespace App\Repository\Legacy;

use App\Entity\Legacy\XbtAnnounceLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method XbtAnnounceLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method XbtAnnounceLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method XbtAnnounceLog[]    findAll()
 * @method XbtAnnounceLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class XbtAnnounceLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, XbtAnnounceLog::class);
    }

    // /**
    //  * @return XbtAnnounceLog[] Returns an array of XbtAnnounceLog objects
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
    public function findOneBySomeField($value): ?XbtAnnounceLog
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
