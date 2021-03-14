<?php

namespace App\Repository\Legacy;

use App\Entity\Legacy\XbtUsers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method XbtUsers|null find($id, $lockMode = null, $lockVersion = null)
 * @method XbtUsers|null findOneBy(array $criteria, array $orderBy = null)
 * @method XbtUsers[]    findAll()
 * @method XbtUsers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class XbtUsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, XbtUsers::class);
    }

    // /**
    //  * @return XbtUsers[] Returns an array of XbtUsers objects
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
    public function findOneBySomeField($value): ?XbtUsers
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
