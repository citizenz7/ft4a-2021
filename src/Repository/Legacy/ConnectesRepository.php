<?php

namespace App\Repository\Legacy;

use App\Entity\Legacy\Connectes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Connectes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Connectes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Connectes[]    findAll()
 * @method Connectes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConnectesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Connectes::class);
    }

    // /**
    //  * @return Connectes[] Returns an array of Connectes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Connectes
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
