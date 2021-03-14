<?php

namespace App\Repository;

use App\Entity\Torrent;
use Doctrine\ORM\Query;
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
            ->execute()
        ;
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
     * @param int $max
     * @return array
     */
    public function popularTorrents(int $max): array
    {
        return $this->createQueryBuilder('t')
            ->select('t.title', 't.slug', 't.image', 't.views')
            ->orderBy('t.views', 'DESC')
            ->setMaxResults($max)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return array
     */
    public function totalViews(): array
    {
        return $this->createQueryBuilder('t')
            ->select('SUM(t.views) AS viewsTotal')
            ->getQuery()
            ->getResult()
        ;
    }
}
