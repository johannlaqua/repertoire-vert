<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Factory\CompanyFactory;
use App\Factory\MarchandiseFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        //UserFactory::new()->createMany(20);
        CompanyFactory::new()->createMany(10);

        MarchandiseFactory::new()->createMany(50, function() {
          return [
            'company' => CompanyFactory::random(),
            'image' => 'http://lorempixel.com/800/600/food/',
          ];
        });
    }
}
