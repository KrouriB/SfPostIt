<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
public function index(): Response
    {
<<  << <<< HEAD
        return $this->render(
            'post/index.html.twig',
            [
            'controller_name' => 'PostController',
            ]
        );
=======
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
>>>>>>> d895528dfd8ca5352f2dc0406b5fb59360676c0a
    }
}
