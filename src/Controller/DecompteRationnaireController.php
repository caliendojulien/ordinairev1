<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DecompteRationnaireController extends AbstractController
{
    #[Route('/decompte-rationnaire', name: 'index_decompte_rationnaire')]
    public function index(): Response
    {
        return $this->render('decompte_rationnaire/decompte_rationnaire.html.twig', [
            'controller_name' => 'DecompteRationnaireController',
        ]);
    }
}
