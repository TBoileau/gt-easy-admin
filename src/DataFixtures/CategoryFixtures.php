<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; ++$i) {
            $category = new Category();
            $category->setName(sprintf('Category %d', $i));
            $manager->persist($category);
        }

        $manager->flush();
    }
}
