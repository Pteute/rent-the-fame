<?php

namespace App\Controller;

use App\Entity\Celebrite;
use App\Repository\CelebriteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CelebriteController extends AbstractController
{
    #[Route('/celebrite/{id}', name: 'celebrite')]
    public function index(Celebrite $celebrite): Response
    {
        return $this->render('celebrite/index.html.twig', [
            'celebrite' => $celebrite,
        ]);
    }

    #[Route('/celebrite/fame/{id}', name: 'fame')]
    public function fame(Celebrite $celebrite, Session $session)
    {
        // $session->clear();
        // $session->set('likes', []);
        $likes = []; //on commence avec un tableau vide
        $message = "Vous avez liké cette star!";
        $type = "info";
        if ($session->has('like')) { // si la session a une clé like, on va récupérer ces informations
            $likes = $session->get('like'); //notre tableau, initialement vide, devient maintenant notre précédent tableau stocké dans la session
        }

        if (!in_array($celebrite->getId(), $likes)) { //si l'id de la celebrité n'est pas présent dans ma session (dans la clé like), je vais le rajouter et modifier ma base de donnée
            array_push($likes, $celebrite->getId()); // je rajoute à mon tableau $likes l'id concerné
            $session->set('like', $likes); //je modifie la valeur de 'like' dans ma session, avec le nouveau tableau
            $entityManager = $this->getDoctrine()->getManager(); //j'appelle l'entity manager

            $celebrite->incrementFame(); //j'incrémente le fame de ma célébrité
            $entityManager->persist($celebrite); //je persiste
            $entityManager->flush(); //je modifie ma base de donnée
        } else {
            $message = "Vous avez déjà liké cette star!"; //le message, étant initialement celui de succès, je le modifie pour lui mettre un message d'erreur
            $type = "error";
        }
        // $session->get('like');
        return new JsonResponse([
            "message" => $message,
            "type"    => $type
        ]);
    }
}
