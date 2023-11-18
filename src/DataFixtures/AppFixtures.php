<?php

namespace App\DataFixtures;

use App\Factory\CategoryFactory;
use App\Factory\PostFactory;
use App\Factory\CommentFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::new()->createMany(10);
        CategoryFactory::new()->createMany(10);

        PostFactory::new()->createMany(50, function () {
            return [
                'comments' => CommentFactory::new()->many(0, 20),
                'category' => CategoryFactory::random(),
                'user'     => UserFactory::random()
            ];
        });
        CommentFactory::new()->createMany(100);
    }
}
