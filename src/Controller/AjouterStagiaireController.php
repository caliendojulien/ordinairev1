<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Form\AjoutStagiaireType;
use App\Repository\UtilisateursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjouterStagiaireController extends AbstractController
{
    #[Route('/ajouter', name: 'app_ajouter')]
    public function ajouter(
        Request                $request,
        EntityManagerInterface $em,

    ): Response
    {

        $ajoutStagiaire = new Utilisateurs();
        $ajoutStagiaireForm = $this->createForm(AjoutStagiaireType::class, $ajoutStagiaire);
        $ajoutStagiaireForm->handleRequest($request);
        dump($ajoutStagiaire);
        if ($ajoutStagiaireForm->isSubmitted() && $ajoutStagiaireForm->isValid()) {
            $ajoutStagiaire->setIsAdmin(true);
            $em->persist($ajoutStagiaire);
            $em->flush();
        }
        return $this->renderForm('ajouter_stagiaire/ajouter.html.twig', compact('ajoutStagiaireForm'));
    }
}

