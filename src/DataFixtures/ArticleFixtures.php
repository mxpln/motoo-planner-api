<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Initialisation du générateur Faker
        $faker = Factory::create('fr_FR');

        $article1 = new Article();

        $article1
            ->setTitle("Comment planifier le meilleur itinéraire ?")
            ->setPicture("Au moment de prendre la route lors d'une balade en moto, la question 
            du chemin à prendre survient. Pour rouler en toute sérénité et choisir le trajet qui vous 
            convient le mieux, il est conseillé de se renseigner en amont. Mais que vérifier et quels 
            moyens utiliser pour trouver le meilleur chemin ?")
            ->setExcerpt("")
            ->setContent("$faker->paragraph(30, true)");

        $manager->persist($article1);

        $article2 = new Article();

        $article2
            ->setTitle("Les meilleurs applications météo")
            ->setPicture("Vous êtes à la recherche de la meilleure application météo pour votre 
            balade en moto ? Trouvez ici la liste des meilleures applications disponibles.")
            ->setExcerpt("")
            ->setContent("$faker->paragraph(30, true)");

        $manager->persist($article2);

        $article3 = new Article();
        $article3
            ->setTitle("Top 10 des points remarquables autour de Saint Malo")
            ->setPicture("Retrouver le top 10 des plus beaux points remarquables et des idées de 
            balade autour de Saint-Malo.")
            ->setExcerpt("")
            ->setContent("$faker->paragraph(30, true)");

        $manager->persist($article3);

        $article4 = new Article();

        $article4
            ->setTitle("Liste des choses à ne pas oublier pendant un roadtrip")
            ->setPicture("Retrouver quelques conseils pour ne rien oublier et parer aux petits aléas 
            sur la route. Liste des 10 choses à savoir si vous partez en roadtrip.")
            ->setExcerpt("")
            ->setContent("$faker->paragraph(30, true)");

        $manager->persist($article4);
    }
}
