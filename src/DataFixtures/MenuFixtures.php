<?php

namespace App\DataFixtures;

use App\Entity\Menu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MenuFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
         $menu = new Menu();
         $menu->setName('Carbonara');
         $menu->setDescription('pattes avec des lardons.');
         $menu->addIngredient($this->getReference('pates'));
         $menu->addIngredient($this->getReference('lardons'));
         $menu->addIngredient($this->getReference('oignons'));
         $manager->persist($menu);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [IngredientFixtures::class];
    }
}
