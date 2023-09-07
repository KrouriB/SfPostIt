<?php

use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
// use Doctrine\Common\DataFixtures\Loader;
// use MyDataFixtures\UserDataLoader;
// use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
// use Doctrine\Common\DataFixtures\Purger\ORMPurger;

// beforeEach(function() {
//     $loader = new Loader();
//     $loader->loadFromFile('/src/DataFixtures/postFixture.php');
//     $executor = new ORMExecutor($entityManager, new ORMPurger());
//     $executor->execute($loader->getFixtures());
// });

it('should have 10 item from the query where the post is done', function(){
    
    $postRepository = $this->container->get(PostRepository::class);

    $finished = $postRepository->findByPostTerminer();
    expect($finished)->toHaveCount(10);
});

it('should have 20 item after modifing try', function(){
    
    $postRepository = $this->container->get(PostRepository::class);
    $entityManager = $this->container->get(EntityManagerInterface::class);

    $todo = $postRepository->findByPostAFaire();
    foreach($todo as $post){
        $post->done();
        // dd($post);
        $entityManager->persist($post);
        $entityManager->flush();
    }

    $postRepository = $this->container->get(PostRepository::class);

    $finished = $postRepository->findByPostTerminer();
    // dd($finished);
    expect($finished)->toHaveCount(20);
});