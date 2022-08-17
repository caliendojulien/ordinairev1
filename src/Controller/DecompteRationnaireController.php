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
        $stage = $stagesRepository->findOneBy(["id" => $id]);
        return $this->render('decompte_rationnaire/decompte_rationnaire.html.twig',
            compact('stage')
        );
    }
}
