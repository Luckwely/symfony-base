<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ArticleController extends AbstractController

{
    #[Route('/article', name: 'article.index')]
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll()
        ]);
    }

    #[Route('/article/{id}/show', name: 'article.show')]
    public function show(int $id, ArticleRepository $articleRepository): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $articleRepository->find($id)
        ]);
    }
}
