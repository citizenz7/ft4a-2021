<?php

namespace App\Repository;

use App\Entity\Licences;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Licences|null find($id, $lockMode = null, $lockVersion = null)
 * @method Licences|null findOneBy(array $criteria, array $orderBy = null)
 * @method Licences[]    findAll()
 * @method Licences[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LicencesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Licences::class);
    }

    // /**
    //  * @return Licences[] Returns an array of Licences objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Licences
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
