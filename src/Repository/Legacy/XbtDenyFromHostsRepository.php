<?php

namespace App\Repository\Legacy;

use App\Entity\Legacy\XbtDenyFromHosts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method XbtDenyFromHosts|null find($id, $lockMode = null, $lockVersion = null)
 * @method XbtDenyFromHosts|null findOneBy(array $criteria, array $orderBy = null)
 * @method XbtDenyFromHosts[]    findAll()
 * @method XbtDenyFromHosts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class XbtDenyFromHostsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, XbtDenyFromHosts::class);
    }

    // /**
    //  * @return XbtDenyFromHosts[] Returns an array of XbtDenyFromHosts objects
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
    public function findOneBySomeField($value): ?XbtDenyFromHosts
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
