<?php

namespace App\Repository\Legacy;

use App\Entity\Legacy\XbtConfig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method XbtConfig|null find($id, $lockMode = null, $lockVersion = null)
 * @method XbtConfig|null findOneBy(array $criteria, array $orderBy = null)
 * @method XbtConfig[]    findAll()
 * @method XbtConfig[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class XbtConfigRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, XbtConfig::class);
    }

    // /**
    //  * @return XbtConfig[] Returns an array of XbtConfig objects
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
    public function findOneBySomeField($value): ?XbtConfig
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
