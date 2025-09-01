<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {

        $nouveauxArticles = $entityManager->getRepository(Article::class)->findBy(
            [],
            ['date' => 'DESC'],
            4
        );

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);  
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();

            $this->addFlash('success', 'Votre message a été envoyé avec succès.');

            // TODO : envoyer un email

            return $this->redirect($this->generateUrl('app_home'));
        }

        return $this->render('home/index.html.twig', [
            'nouveauxArticles' => $nouveauxArticles,
            'contactForm' => $form->createView(),
        ]);
    }
}
