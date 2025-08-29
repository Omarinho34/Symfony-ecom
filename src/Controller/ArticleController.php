<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\StockRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(): Response
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

    #[Route('/article/{id}', name: 'show_article')]
    public function getArticleInfo(int $id, ArticleRepository $articleRepository, StockRepository $stockRepository): Response
    {
        // Récupérer les informations de l'article (id,nom,description,prix,stock,categorie,date)
        $article = $articleRepository->find($id);
        // Vérifier si l'article existe
        if (!$article) {
            throw $this->createNotFoundException('Article not found');
        }

        // Récupérer les stocks
        $stocks = $stockRepository->findBy(['article' => $article]);

        $sizes = [];
        $concentrations = [];
        foreach ($stocks as $stock) {
            if ($stock->getSize() && !in_array($stock->getSize(), $sizes, true)) {
                $sizes[] = $stock->getSize();
            }
            if ($stock->getConcentration() && !in_array($stock->getConcentration(), $concentrations, true)) {
                $concentrations[] = $stock->getConcentration();
            }
        }

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'article' => $article,
            'stocks' => $stocks,
            'sizes' => $sizes,
            'concentrations' => $concentrations,
        ]);
    }
}
