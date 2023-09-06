<?php

use App\Entity\Post;
use App\DataFixtures\PostFixtures;
use App\Repository\PostRepository;
use Doctrine\Persistence\ObjectManager;

it('should have 10 item from the query where the post is done', function(){
    
    $postRepository = $this->container->get(PostRepository::class);

    $finished = $postRepository->findByPostTerminer();
    expect($finished)->toHaveCount(10);
});

// it('should have 20 item after modifing try', function(PostRepository $postRepository){
//     $todo = $postRepository->findByPostAFaire();
// });