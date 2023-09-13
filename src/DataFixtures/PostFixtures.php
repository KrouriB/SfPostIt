<?php

namespace App\DataFixtures;

use DateTime;
use DateInterval;
use App\Entity\Post;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($count = 0; $count < 10; $count++) {
            $post = new Post();

            $title = "Titre Fixture";
            $post->setTitre($title);

            $info = "Information Fixture";
            $post->setInformation($info);

            $today = new DateTime();
            $post->setDateCreation($today);

            $rand_day = rand(01, 31);
            $late = new DateTime('2023/10/' . strval($rand_day));
            $post->setDateFaite($late);

            $rand_day = rand(01, 31);
            $later = new DateTime('2023/11/' . strval($rand_day));
            $post->setDateLimite($later);

            $manager->persist($post);
            $manager->flush();
        }
        for ($count = 0; $count < 10; $count++) {
            $post = new Post();

            $title = "Titre Fixture";
            $post->setTitre($title);

            $info = "Information Fixture";
            $post->setInformation($info);

            $today = new DateTime();
            $post->setDateCreation($today);

            $rand_day = rand(01, 31);
            $later = new DateTime('2023/12/' . strval($rand_day));
            $post->setDateLimite($later);

            $manager->persist($post);
            $manager->flush();
        }
    }
}
