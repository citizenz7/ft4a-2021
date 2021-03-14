<?php

namespace App\Repository\Legacy;

use App\Entity\Legacy\BlogMessages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlogMessages|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogMessages|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogMessages[]    findAll()
 * @method BlogMessages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogMessagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogMessages::class);
    }

    // /**
    //  * @return BlogMessages[] Returns an array of BlogMessages objects
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
    public function findOneBySomeField($value): ?BlogMessages
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
