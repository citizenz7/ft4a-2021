<?php

namespace App\Repository\Legacy;

use App\Entity\Legacy\BlogLicences;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlogLicences|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogLicences|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogLicences[]    findAll()
 * @method BlogLicences[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogLicencesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogLicences::class);
    }
}
