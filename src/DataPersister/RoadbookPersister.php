<?php


namespace App\DataPersister;


use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Roadbook;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class RoadbookPersister implements DataPersisterInterface
{
    protected EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function supports($data): bool
    {
        return $data instanceof Roadbook;
    }

    public function persist($data): object
    {
        // 1. Mettre une date de création sur le roadbook
        //    ajouter les autres champs : share_link, share_password, status
        $data
            ->setCreatedAt(new DateTime())
            ->setStatus(1)
            ->setShareLink(random_bytes(10))
            ->setSharePassword(random_bytes(6));

        // 2. Demander à Doctrine de persister
        $this->em->persist($data);
        $this->em->flush();
    }

    public function remove($data)
    {
        // 1. Demander à Doctrine de supprimer l'article
        $this->em->remove($data);
        $this->em->flush();
    }
}
