<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use App\Entity\Produit;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

      for($j=0;$j<(mt_rand(5,10));$j++){

          $type1=new Type();
          $type1->setLabel($faker ->colorName());
          $manager->persist($type1);
      }

       for ($i=0;$i<10;$i++){
           $p1=new Produit();
           $p1->setLabel($faker->sentence())
               ->setType($type1)
               ->setImageProduit($faker->imageUrl())
               ->setPrix(mt_rand(1, 5));

           $ig1=new Ingredient();
           $ig1->setLabel($faker->sentence());
           $ig1->setIsAllergen(true);
           $ig1->addProduit($p1);
           $manager->persist($ig1);

           $p1->addIngredient($ig1);
           $manager->persist($p1);
       }
        $manager->flush();
    }
}
