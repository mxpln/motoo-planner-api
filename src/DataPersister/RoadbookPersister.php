<?php


namespace App\DataPersister;


use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Roadbook;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class RoadbookPersister implements ContextAwareDataPersisterInterface
{
    private EntityManagerInterface $em;

    private ?Request $request;

    private SluggerInterface $slugger;


    public function __construct(EntityManagerInterface $em, RequestStack $request, SluggerInterface $slugger)
    {
        $this->em = $em;
        $this->request = $request->getCurrentRequest();
        $this->slugger = $slugger;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Roadbook;
    }

    public function persist($data, array $context = []): object
    {
        // 1. Mettre une date de création sur le roadbook
        //    ajouter les autres champs : share_link, share_password, status
        if ($this->request->getMethod() === 'POST') {
            $data
                ->setCreatedAt(new DateTime('now'))
                ->setUpdatedAt(new DateTime('now'))
                ->setStatus(1)
                ->setShareLink($this->slugger->slug(strtolower($data->getTitle())). '-' .uniqid());
        }

        // Set the updatedAt value if it's not a POST request
        if ($this->request->getMethod() !== 'POST') {
            $data->setUpdatedAt(new DateTime('now'));
        }

        // 2. Demander à Doctrine de persister le roadbook
        $this->em->persist($data);
        $this->em->flush();

        return $data;
    }

    public function remove($data, array $context = [])
    {
        // 1. Demander à Doctrine de supprimer le roadbook
        $this->em->remove($data);
        $this->em->flush();
    }
}
