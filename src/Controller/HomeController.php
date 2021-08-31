<?php

namespace App\Controller;

use App\Repository\CelebriteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    
    public function index(CelebriteRepository $celebriteRepository): Response
    {

        $nouveaute = $celebriteRepository->findBy(array(), array('id' => 'DESC'), 1, 0);

        return $this->render('home/index.html.twig', [
            'celebrites' => $celebriteRepository->findAll(),
            'nouveaute' => $nouveaute,
         ]);
    }

    
}
