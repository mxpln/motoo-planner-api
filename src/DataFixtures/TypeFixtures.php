<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $home = new Type();
        $home->setName('Départ / Arrivée')->setSlug('home')->setIcon('faHome');
        $manager->persist($home);
        $this->addReference("type-1", $home);

        $location = new Type();
        $location->setName('Pause')->setSlug('location')->setIcon('faMapMarkerAlt');
        $manager->persist($location);
        $this->addReference("type-2", $location);

        $restaurant = new Type();
        $restaurant->setName('Restaurant')->setSlug('restaurant')->setIcon('faUtensils');
        $manager->persist($restaurant);
        $this->addReference("type-3", $restaurant);

        $visite = new Type();
        $visite->setName('Visite')->setSlug('visite')->setIcon('faMonument');
        $manager->persist($visite);
        $this->addReference("type-4", $visite);

        $hotel = new Type();
        $hotel->setName('Hotel')->setSlug('hotel')->setIcon('faBed');
        $manager->persist($hotel);
        $this->addReference("type-5", $hotel);

        $manager->flush();
    }
}
