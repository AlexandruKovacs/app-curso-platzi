<?php

namespace App\DataFixtures;

use App\Factory\CategoryFactory;
use App\Factory\PostFactory;
use App\Factory\CommentFactory;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        CategoryFactory::new()->createMany(10);
        PostFactory::new()->createMany(50, function () {
            return [
                'comments' => CommentFactory::new()->many(0, 20),
                'category' => CategoryFactory::random()
            ];
        });
        CommentFactory::new()->createMany(100);
    }
}
