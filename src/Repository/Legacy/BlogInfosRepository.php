<?php

namespace App\Repository\Legacy;

use App\Entity\Legacy\BlogInfos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlogInfos|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogInfos|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogInfos[]    findAll()
 * @method BlogInfos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogInfosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogInfos::class);
    }

    // /**
    //  * @return BlogInfos[] Returns an array of BlogInfos objects
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
    public function findOneBySomeField($value): ?BlogInfos
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
