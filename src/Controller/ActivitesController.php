<?php

namespace App\Controller;

use App\Entity\Activite;
use App\Repository\ActiviteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActivitesController extends AbstractController
{
    #[Route('/activites', name: 'activites')]
    public function liste(ActiviteRepository $activiteRepository): Response
    {
        return $this->render('activites/liste.html.twig',([
            "activites" => $activiteRepository->findAll()
        ]));
    }

    #[Route('/activite/{id}', name: 'activite')]
    public function index(Activite $activite): Response
    {
        return $this->render('activites/index.html.twig', [
            'activite' => $activite,
        ]);
    }
}
