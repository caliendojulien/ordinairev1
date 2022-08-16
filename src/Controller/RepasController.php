<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RepasController extends AbstractController
{
    #[Route('/repas', name: 'repas')]
    public function repas(): Response
    {
        return $this->render('repas/index.html.twig', [
            'controller_name' => 'RepasController',
        ]);
    }
}
