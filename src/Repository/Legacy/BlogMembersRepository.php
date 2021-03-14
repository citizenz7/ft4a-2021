<?php

namespace App\Repository\Legacy;

use App\Entity\Legacy\BlogMembers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlogMembers|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogMembers|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogMembers[]    findAll()
 * @method BlogMembers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogMembersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogMembers::class);
    }

    // /**
    //  * @return BlogMembers[] Returns an array of BlogMembers objects
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
    public function findOneBySomeField($value): ?BlogMembers
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
