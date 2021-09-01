<?php

namespace App\Controller;

use App\Entity\Celebrite;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MediasController extends AbstractController
{
    #[Route('/medias', name: 'medias')]
    public function index(Celebrite $celebrite): Response
    {
        return $this->render('medias/index.html.twig', [
            'celebrite' => $celebrite,
        ]);
    }
}
