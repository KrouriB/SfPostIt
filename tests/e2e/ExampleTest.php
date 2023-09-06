<?php

use App\Entity\Post;
use App\DataFixtures\PostFixtures;
use App\Repository\PostRepository;
use Doctrine\Persistence\ObjectManager;

// it('should show a page', function () {
//     $this->client->request('GET' , '/bonjour');
    
//     //remplir des formulaires
    
//     expect($this->container->get(PostRepository::class)->findAll()->count())->toBe(11);
// }