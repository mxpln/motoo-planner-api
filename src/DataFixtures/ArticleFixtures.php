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

        for($i = 1; $i <= 10; $i++) {
            $article = new Article();

            $article
                ->setTitle($faker->sentence(5, true))
                ->setPicture('')
                ->setExcerpt($faker->text(150))
                ->setContent($faker->paragraph(30, true));

            $manager->persist($article);
        }

        $manager->flush();
    }
}
