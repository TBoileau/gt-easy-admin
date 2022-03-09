<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Feature;
use App\Entity\FeatureValue;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        /** @var array<array-key, Category> $categories */
        $categories = $manager->getRepository(Category::class)->findAll();

        /** @var array<array-key, Feature> $features */
        $features = $manager->getRepository(Feature::class)->findAll();

        $index = 1;

        foreach ($categories as $category) {
            for ($i = 1; $i <= 5; ++$i) {
                $product = new Product();
                $product->setName(sprintf('Product %d', $index));
                $product->setCategory($category);
                $product->setImage('image.png');
                $product->setPrice(rand(1000, 100000));
                $product->setTax(0.2);

                shuffle($features);

                foreach (array_slice($features, 0, 3) as $feature) {
                    $product->addFeature(
                        (new FeatureValue())
                            ->setFeature($feature)
                            ->setValue($feature->getName())
                    );
                }

                $index++;

                $manager->persist($product);
            }
            $manager->flush();
        }
    }

    public function getDependencies(): array
    {
        return [CategoryFixtures::class, FeatureFixtures::class];
    }
}
