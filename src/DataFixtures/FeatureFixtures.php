<?php

namespace App\DataFixtures;

use App\Entity\Feature;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class FeatureFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; ++$i) {
            $feature = new Feature();
            $feature->setName(sprintf('Feature %d', $i));
            $manager->persist($feature);
        }

        $manager->flush();
    }
}
