<?php

namespace App\Repository\Legacy;

use App\Entity\Legacy\BlogCats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlogCats|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogCats|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogCats[]    findAll()
 * @method BlogCats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogCatsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogCats::class);
    }

    // /**
    //  * @return BlogCats[] Returns an array of BlogCats objects
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
    public function findOneBySomeField($value): ?BlogCats
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
