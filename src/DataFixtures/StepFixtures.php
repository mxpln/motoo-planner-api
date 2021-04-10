<?php

namespace App\DataFixtures;

use App\Entity\Step;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class StepFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Initialisation du générateur Faker
        $faker = Factory::create('fr_FR');

        for($i = 1; $i <= 60; $i++) {

            $step = new Step();

            $step
                ->setStepDate($faker->dateTimeBetween('now', '+1 days'))
                ->setStepLat($faker->randomFloat(15, 47, 48))
                ->setStepLong($faker->randomFloat(15, -2, -1))
                ->setTitle($faker->sentence(7, true))
                ->setDescription($faker->sentence(10, true))
                ->setRoadbook($this->getReference('book-' . mt_rand(1, 15)))
                ->setType($this->getReference('type-' . mt_rand(1, 5)));

            $manager->persist($step);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SuggestionFixtures::class,
            RoadbookFixtures::class,
            TypeFixtures::class
        ];
    }
}
