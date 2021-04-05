<?php

namespace App\Repository;

use App\Entity\TorrentFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TorrentFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method TorrentFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method TorrentFile[]    findAll()
 * @method TorrentFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TorrentFileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TorrentFile::class);
    }

    // /**
    //  * @return TorrentFile[] Returns an array of TorrentFile objects
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
    public function findOneBySomeField($value): ?TorrentFile
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
