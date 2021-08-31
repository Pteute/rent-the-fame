<?php

namespace App\Controller;

use App\Repository\CelebriteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $nouveaute; //je déclare une variable privée (uniquement accessible à notre classe Home), pour pouvoir atteindre cette valeur dans notre array_filter (à cause du problème de scope de la fonction function($item))
    /**
     * @Route("/", name="home")
     */
    
    public function index(CelebriteRepository $celebriteRepository): Response
    {

        $this->nouveaute = $celebriteRepository->findBy(array(), array('id' => 'DESC'), 1, 0)[0]; // on stocker dans nouveauté le dernier élément de ma liste de celebrité. FindBy, me retournant un tableau, je récupère le premier avec [0] (de toute manière il n'y en aura qu'un puisque j'ai indiqué limit = 1)
        //findBy(critère de recherches, ordre de classement, la limite (ici j'en recupère qu'un, l'offset (le décalage))) [0] permet de récupérer que le premier de cette recherche
        $listeCelebrite = $celebriteRepository->findAllCelebrities(); //On fait une requête personnalisée depuis notre repository celebrite, pour faire l'équivalent d'un findAll() mais en tableau associatif sans notion d'entité pour pouvoir utiliser les fonctions php array_****
      
        $listeCelebriteLight = array_filter($listeCelebrite, function($item){return $item["image"] !== $this->nouveaute->getImage();});//je récupère dans une variable listeCelebriteLight, depuis le tableau listeCelebrite, tous les items qui ont une image différente de l'image de ma nouveauté

        $monCoupDeCoeur = random_int(0, (count($listeCelebriteLight)) - 1); // je créé un nombre aléatoire qui me servira d'index, compris entre 0 et le nombre d'éléments dans mon tableau filtré (qui ne contient pas ma nouveauté), auquel j'enlève 1 (on part bien de 0 pour l'index)
        return $this->render('home/index.html.twig', [
            'celebrites' => $listeCelebrite,
            'nouveaute' => $this->nouveaute,
            'monCoupDeCoeur' => $listeCelebriteLight[$monCoupDeCoeur], // on va bien récupérer depuis le tableau ne contenant pas ma nouveauté, l'index aléatoirement généré. Donc une célébrité, n'étant pas celle de ma nouveauté, aléatoirement récupérée
         ]);
    }

    
}
