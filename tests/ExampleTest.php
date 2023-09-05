<?php

use App\Entity\Post;


test('test si la date limite fonctionne', function () {
    $date = new \DateTime('2024-01-01');
    $post = new Post();
    $post->setDateLimite($date);
    expect($post->getDateLimite())->toBeGreaterThan(new \Datetime());
});

test('exception passé', function () {
    $date = new \DateTime('2023-01-01');
    $post = new Post();
    $post->setDateCreation(new \Datetime());
    expect($post->getDateCreation())->toBeGreaterThan($date);
});

test('not Terminer', function () {
    $post = new Post();
    expect($post->getEtat())->not->toBe('Terminer');
});
