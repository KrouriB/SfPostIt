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
    $this->assertSame(200, $this->client->getResponse()->getStatusCode());

    $form = $crawler->selectButton('post_valider')->form();
    $form['post[titre]']->setValue('Pest test');
    $form['post[information]']->setValue('Test via pest');
    $form['post[dateLimite]']->setValue('2023/12/23');
    // dd($form);

    // dd($this->client->submit($form));

    $all = $postRepository->findAll();

    // dd($all);
    
    expect($all)->toHaveCount(21);
});