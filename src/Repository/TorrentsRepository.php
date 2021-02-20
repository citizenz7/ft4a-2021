<?php

namespace App\Repository;

use App\Entity\Torrents;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Torrents|null find($id, $lockMode = null, $lockVersion = null)
 * @method Torrents|null findOneBy(array $criteria, array $orderBy = null)
 * @method Torrents[]    findAll()
 * @method Torrents[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TorrentsRepository extends ServiceEntityRepository
{
    /**
     * TorrentsRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Torrents::class);
    }

    /**
     * @return array
     */
    public function popularTorrents(): array
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.views', 'DESC')
            ->setMaxResults(3)
            ->select('a.title', 'a.slug', 'a.image', 'a.views')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return array
     */
    public function totalViews(): array
    {
        return $this->createQueryBuilder('a')
            ->select('SUM(a.views) AS viewsTotal')
            ->getQuery()
            ->getResult()
            ;
    }


    // /**
    //  * @return Torrents[] Returns an array of Torrents objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Torrents
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
