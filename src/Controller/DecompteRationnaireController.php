<?php

namespace App\Controller;

use App\Repository\StagesRepository;
use App\Repository\UtilisateursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DecompteRationnaireController extends AbstractController
{
    #[Route('/decompte-rationnaire/{id}', name: 'index_decompte_rationnaire')]
    public function index(
        $id,
        StagesRepository $stagesRepository
    ): Response
    {
        $listeStage = $stagesRepository->findAll();


        $Lundi = strtotime('next monday +2 weeks');
        $Mardi = strtotime('next monday +2 weeks +1 day');
        $Mercredi = strtotime('next monday +2 weeks +2 days');
        $Jeudi = strtotime('next monday +2 weeks +3 days');
        $Vendredi = strtotime('next monday +2 weeks +4 days');


        return $this->render('decompte_rationnaire/decompte_rationnaire.html.twig',
            [
                'Lundi' => $Lundi,
                'Mardi' => $Mardi,
                'Mercredi' => $Mercredi,
                'Jeudi' => $Jeudi,
                'Vendredi' => $Vendredi,
                'listeStage' => $listeStage
            ]
        );
    }
}
