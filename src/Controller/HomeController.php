<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        $nouveauxArticles = $entityManager->getRepository(Article::class)->findBy(
            [],
            ['date' => 'DESC'],
            4
        );
        
        //$articles = $entityManager->getRepository(Article::class)->findAll();



        return $this->render('home/index.html.twig', [
            'nouveauxArticles' => $nouveauxArticles,
        ]);
    }
}
