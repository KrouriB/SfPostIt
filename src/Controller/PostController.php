<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function index(Request $request, PostRepository $postRepository, EntityManagerInterface $entityManager): Response
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('app_post');
        }

        $today = date('Y-m-d H:i:s');
        $aFaire = $postRepository->findByPostAFaire();
        $terminer = $postRepository->findByPostTerminer();
        return $this->render(
            'post/index.html.twig',
            [
                'post' => $form->createView(),
                'today' => $today,
                'aFaire' => $aFaire,
                'terminer' => $terminer,
            ]
        );
    }
}
