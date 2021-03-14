<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class CommentRepository
 * @package App\Repository
 *
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    /**
     * CommentsRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    /**
     * Retourne les 3 derniers commentaires (par date)
     * @return array
     */
    public function lastComments(): array
    {
        return $this->createQueryBuilder('c')
            // TODO : Supprimer le code commenté
            //->andWhere('a.exampleField = :val')
            //->setParameter('val', $value)
            ->join('c.author', 'a')
            ->join('c.torrent', 'b')
            ->orderBy('c.id', 'DESC')
            ->select('a.username', 'b.slug', 'b.title', 'c.id', 'c.content', 'c.date')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }
}
