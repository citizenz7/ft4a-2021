<?php

namespace App\Repository;

use App\Entity\Torrent;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class TorrentRepository
 * @package App\Repository
 *
 * @method Torrent|null find($id, $lockMode = null, $lockVersion = null)
 * @method Torrent|null findOneBy(array $criteria, array $orderBy = null)
 * @method Torrent[]    findAll()
 * @method Torrent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TorrentRepository extends ServiceEntityRepository
{
    /**
     * TorrentsRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Torrent::class);
    }

    /**
     * @param $title
     * @return int|mixed|string
     */
    public function search($title)
    {
        return $this->createQueryBuilder('Torrents')
            ->andWhere('Torrents.title LIKE :title')
            ->setParameter('title', '%'.$title.'%')
            ->getQuery()
            ->execute();
    }

    /**
     * @return Query
     */
    public function findTorrents(): Query
    {
        $qb = $this->createQueryBuilder('p');
        return $qb->getQuery();
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
}
