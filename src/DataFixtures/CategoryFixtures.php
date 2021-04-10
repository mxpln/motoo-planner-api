<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $hotel = new Category();
        $hotel->setName('Hotel')->setSlug('hotel');
        $manager->persist($hotel);
        $this->addReference("cat-hotel", $hotel);

        $restaurant = new Category();
        $restaurant->setName('Restaurant')->setSlug('restaurant');
        $manager->persist($restaurant);
        $this->addReference("cat-restaurant", $restaurant);

        $interest = new Category();
        $interest->setName("Visite")->setSlug('visite');
        $manager->persist($interest);
        $this->addReference("cat-interest", $interest);

        $manager->flush();
    }
}
