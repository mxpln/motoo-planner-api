<?php

namespace App\DataFixtures;

use App\Entity\Roadbook;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class RoadbookFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Initialisation du générateur Faker
        $faker = Factory::create('fr_FR');

        for($i = 1; $i <= 15; $i++) {

            $date = $faker->dateTimeBetween('-4 months');

            $book = new Roadbook();

            $book
                ->setTitle($faker->sentence(4, true))
                ->setDescription($faker->sentence(8, true))
                ->setStatus($faker->numberBetween(0,1))
                ->setPictureUrl('https://picsum.photos/300/200')
                ->setCreatedAt($date)
                ->setTripStart($faker->dateTimeBetween('now', '+4 months'))
                ->setShareLink($faker->uuid)
                ->setSharePassword($faker->password);

            $book->setUser($this->getReference('user-' . mt_rand(1, 10)));

            $manager->persist($book);

            $this->addReference("book-" . $i, $book);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}
