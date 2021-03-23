<?php

namespace App\Repository;

use App\Entity\Roadbook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Roadbook|null find($id, $lockMode = null, $lockVersion = null)
 * @method Roadbook|null findOneBy(array $criteria, array $orderBy = null)
 * @method Roadbook[]    findAll()
 * @method Roadbook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoadbookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Roadbook::class);
    }

    /**
     * @return int|mix|string
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countAllRoadbook()
    {
        $queryBuilder = $this->createQueryBuilder('a');
        $queryBuilder->select('COUNT(a.id) as value');

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }


    /*
    public function findOneBySomeField($value): ?Roadbook
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
