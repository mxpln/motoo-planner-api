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

    // récupération des données d'un roadbook en fonction du slug
    public function findOneRoadbookShare($slug): ?Roadbook
    {
        return $this->createQueryBuilder('r')   // SELECT * FROM roadbook AS r
            ->addSelect('informations')        // on fait une liaison avec table informations
            ->addSelect('checklists')          // on fait une liaison avec table checklists
            ->addSelect('steps')               // on fait une liaison avec table steps
            ->innerJoin('r.informations', 'informations')
            ->innerJoin('r.checklists', 'checklists')
            ->innerJoin('r.steps', 'steps')
            ->where('r.shareLink = :slug')   // on récupère le roadbook avec le slug passé en paramètre
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}









