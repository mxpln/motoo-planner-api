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

        for($i = 1; $i <= 6; $i++) {
            $article = new Article();

            $article
                ->setTitle($faker->sentence(5, true))
                ->setPicture('https://picsum.photos/800/500')
                ->setExcerpt($faker->text(150))
                ->setContent($faker->paragraph(8, true));

            $manager->persist($article);
        }

        $manager->flush();
    }
}