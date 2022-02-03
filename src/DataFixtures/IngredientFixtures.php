<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class IngredientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ingredient = new Ingredient();
        $ingredient->setName('confit de canard');
        $this->addReference('confit de canard', $ingredient);
        $manager->persist($ingredient);

        $ingredient2 = new Ingredient();
        $ingredient2->setName('patates');
        $this->addReference('patates', $ingredient2);
        $manager->persist($ingredient2);

        $ingredient3 = new Ingredient();
        $ingredient3->setName('oignons');
        $this->addReference('oignons', $ingredient3);
        $manager->persist($ingredient3);

        $ingredient4 = new Ingredient();
        $ingredient4->setName('champignons');
        $this->addReference('champignons', $ingredient4);
        $manager->persist($ingredient4);

        $ingredient5 = new Ingredient();
        $ingredient5->setName('lardons');
        $this->addReference('lardons', $ingredient5);
        $manager->persist($ingredient5);

        $ingredient6 = new Ingredient();
        $ingredient6->setName('pates');
        $this->addReference('pates', $ingredient6);
        $manager->persist($ingredient6);

        $manager->flush();
    }
}
