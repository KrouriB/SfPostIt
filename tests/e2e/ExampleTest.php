<?php

use App\Repository\PostRepository;



it('should show a page', function () {
    $crawler = $this->client->request('GET' , '/post');

    $this->assertSame(200, $this->client->getResponse()->getStatusCode());
    
    $this->assertSelectorTextContains('h2', 'PostIt A faire :');
});

it('should create a post', function () {
    $postRepository = $this->container->get(PostRepository::class);
    $crawler = $this->client->request('GET' , '/post/new');
    // $this->assertSame(200, $this->client->getResponse()->getStatusCode());
    dd($crawler);

    $form = $crawler->selectButton('valider')->form();
    // dd($form);
    $form['titre']->setValue('Pest test');
    $form['information']->setValue('Test via pest');
    $form['dateLimite']->setValue('2023/12/23');

    $this->client->submit($form);
    
    $this->assertTrue($client->getResponse()->isRedirect());

    $all = $postRepository->findAll();
    // dd($all);
    
    expect($all)->toHaveCount(21);
});