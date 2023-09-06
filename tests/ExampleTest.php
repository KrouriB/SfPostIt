<?php

use App\Entity\Post;
use App\DataFixtures\PostFixtures;
use App\Repository\PostRepository;
use Doctrine\Persistence\ObjectManager;

// test('test si la date limite fonctionne', function () {
//     $date = new \DateTime('2024-01-01');
//     $post = new Post();
//     $post->setDateLimite($date);
//     expect($post->getDateLimite())->toBeGreaterThan(new \Datetime());
// });

// test('exception passé', function () {
//     $date = new \DateTime('2023-01-01');
//     $post = new Post();
//     $post->setDateCreation(new \Datetime());
//     expect($post->getDateCreation())->toBeGreaterThan($date);
// });

// test('not Terminer', function () {
//     $post = new Post();
//     expect($post->getEtat())->not->toBe('Terminer');
// });


// --> HAPPY PATH : chemin heureux --> cas normal de l'application
it('should register a post with a future date' , function(){

    //optionnel : arrange : mettre ton SUT (system under test) dans un etat connu

    //act : executer les actions
    $post = new Post(new DateTime('2024-01-01'));

    //assert : verifier l'etat modifié
    $today = new DateTime();
    expect($post->getDateLimite())->toBeGreaterThan($today);

});


// SAD PATH -> chemin pas heureux --> cas d'utilisation problematique
it('should not register a post with a past expiration date' , function(){

    //act : executer les actions
    $post = new Post(new DateTime('2022-01-01'));

})->throws(InvalidArgumentException::class);


it('should not register a post if status is done at creation', function () {

    $post = new Post();
    expect($post->isFinished())->toBeFalse();

});

it('should detect a post as finished if done date is defined', function () {

    $post = new Post();
    $post->done();

    expect($post->isFinished())->toBeTrue();
});

it('should have 10 item from the query where the post is done', function(PostRepository $postRepository){
    
    $finished = $postRepository->findByPostTerminer();
    expect($finished)->toHaveCount(10);
});

// it('should have 20 item after modifing try', function(PostRepository $postRepository){
//     $todo = $postRepository->findByPostAFaire();
// });