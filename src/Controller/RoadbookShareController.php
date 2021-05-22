<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RoadbookRepository;
use Symfony\Component\Serializer\SerializerInterface;

class RoadbookShareController
{
    /**
     * Récupération des données d'un roadbook partagé
     *
     * @Route("/share/{shareLink}", name="app_share_roadbook")
     */
    public function getRoadbookShare(string $shareLink, RoadbookRepository $roadbookRepository, SerializerInterface $serializer): Response
    {
        // exécution requête personnalisé pour récupérer le contenu d'un roadbook
        $roadbook = $roadbookRepository->findOneRoadbookShare($shareLink);

        // on trasnforme en JSON le résultat de la requête qui est de type persistentcollection
        $roadbookSerialized = $serializer->serialize($roadbook, 'json');

        return new Response($roadbookSerialized);
    }
}



