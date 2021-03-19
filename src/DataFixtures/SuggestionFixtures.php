<?php

namespace App\DataFixtures;

use App\Entity\Suggestion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SuggestionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Initialisation du générateur Faker
        $faker = Factory::create('fr_FR');

        for($i = 1; $i <= 15; $i++) {

            $suggest = new Suggestion();

            $suggest
                ->setAddress($faker->address)
                ->setZipcode($faker->postcode)
                ->setCity($faker->city)
                ->setCountry('France')
                ->setPhone($faker->phoneNumber)
                ->setDescription($faker->sentence(10, true))
                ->setPicture('https://picsum.photos/300/200')
                ->setCreatedAt($faker->dateTimeBetween('-4 months'))
                ->setSuggestLat($faker->randomFloat(15, 47, 48))
                ->setSuggestLong($faker->randomFloat(15, -2, -1))
                ->addCategory($this->getReference("cat-restaurant"));

            $manager->persist($suggest);

            $this->addReference("suggest-" . $i, $suggest);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class
        ];
    }
}
