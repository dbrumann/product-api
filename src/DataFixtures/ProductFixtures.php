<?php declare(strict_types = 1);

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

final class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $banana = new Product();
        $banana->id = 123;
        $banana->name = 'Apple';
        $banana->description = 'A tasty snack.';
        $banana->price = 49;
        $banana->taxRate = 700;
        $manager->persist($banana);

        $banana = new Product();
        $banana->id = 234;
        $banana->name = 'Banana';
        $banana->description = 'Popular yellow fruit.';
        $banana->price = 39;
        $banana->taxRate = 700;
        $manager->persist($banana);

        $mix = new Product();
        $mix->id = 345;
        $mix->name = 'Fruit Basket';
        $mix->description = 'A selection of multiple fruits.';
        $mix->price = 3999;
        $mix->taxRate = 1900;
        $manager->persist($mix);

        $manager->flush();
    }
}
