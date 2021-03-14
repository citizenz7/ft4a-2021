<?php

namespace App\Repository\Legacy;

use App\Entity\Legacy\XbtFiles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method XbtFiles|null find($id, $lockMode = null, $lockVersion = null)
 * @method XbtFiles|null findOneBy(array $criteria, array $orderBy = null)
 * @method XbtFiles[]    findAll()
 * @method XbtFiles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class XbtFilesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, XbtFiles::class);
    }

    // /**
    //  * @return XbtFiles[] Returns an array of XbtFiles objects
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
    public function findOneBySomeField($value): ?XbtFiles
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
