<?php

namespace App\Controller;


use App\Entity\Session;

use App\Form\SessionType;
use App\Service\SessionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#[Route('/session', name: 'session_')]
final class SessionController extends AbstractController
{
    #[Route('/list', name: 'list', methods: ['GET'])]
    public function list(SessionService $sessionService): Response
    {
        $sessions = $sessionService->getAllSession();

        return $this->render('session/index.html.twig', [
            'sessions' => $sessions,
        ]);
    }

    #[Route('/create', name: 'create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        // Step 1 : Instancier un formulaire (dans notre cas avec données vide)
        // param1: Quel est le formulaire
        // param2: la donnée par défaut dans le formulaire
        $session = new Session();

        // Attention on envoie l'addresse mémoire de $course
        // Cela veut dire que l'objet liée au formulaire dans la mémoire de la machine
        $form = $this->createForm(SessionType::class, $session);

        // Je récupère les données SI saisies
        // PS: Ca injecte les données du formulaire saisie dans l'adresse mémoire
        // de course, remplir l'objet course avec les données saisies
        // ATTENTION : SI ON A SAISIE ET SUBMIT
        $form->handleRequest($request);

        // Pour savoir si il y'a eu un submit
        if ($form->isSubmitted() && $form->isValid()) {




            // Prévenir qu'on manipule l'objet Course pour le BDD/ORM
            $em->persist($session);

            // Envoyer dans la BDD
            $em->flush();

            // TODO : Rediriger sur une page avec message succès
            // Envoyer un message succès
            $this->addFlash("success", "Le cours a été enregistré avec succès !");

            // Rediriger sur l'accueil
            return $this->redirectToRoute('session_list');
        }

        // Attention !
        // On note bien que le formulaire est envoyé dans le front
        return $this->render('session/create.html.twig', [
            'sessionForm' => $form->createView(),
        ]);
    }
}
