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
    #[Route('/post/{id}/fini', name: 'app_fini')]
    public function fini(Request $request, EntityManagerInterface $entityManager): Response
    {
        $postId = $request->get('id');

        $post = $entityManager->getRepository(Post::class)->find($postId);

        $post->done();

        $entityManager->persist($post);
        $entityManager->flush();

        return $this->redirectToRoute('app_post');
    }

    #[Route('/post/{id}/refaire', name: 'app_refaire')]
    public function refaire(Request $request, EntityManagerInterface $entityManager): Response
    {
        $postId = $request->get('id');

        $post = $entityManager->getRepository(Post::class)->find($postId);

        $post->notDone();

        $entityManager->persist($post);
        $entityManager->flush();

        return $this->redirectToRoute('app_post');
    }

    #[Route('/post/new', name: 'app_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
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

        $today = date('Y-m-d');
        return $this->render(
            'post/new.html.twig',
            [
                'post' => $form->createView(),
                'today' => $today,
            ]
        );
    }

    #[Route('/post', name: 'app_post')]
    public function index(PostRepository $postRepository): Response
    {

        $today = date('Y-m-d');
        $aFaire = $postRepository->findByPostAFaire();
        $terminer = $postRepository->findByPostTerminer();
        return $this->render(
            'post/index.html.twig',
            [
                'today' => $today,
                'aFaire' => $aFaire,
                'terminer' => $terminer,
            ]
        );
    }
}
