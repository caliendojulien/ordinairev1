<?php

namespace App\Controller;

use App\Entity\Promotion;
use App\Entity\Repas;
use App\Entity\Stages;
use App\Form\PromotionType;
use App\Form\RepasType;
use App\Repository\AdminRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DecompteRationnaireController extends AbstractController
{
    #[Route('/decompte', name: 'decompte_index')]
    public function index(): Response
    {

        $today = new DateTime();
        $week = $today->format("W");

        return $this->render('decompte_rationnaire/decompte_rationnaire.html.twig', compact('week')

        );
    }

    #[Route('/mespromotions', name: 'mespromotions_voirPromotions')]
    public function voirPromotions(
        AdminRepository        $adminRepository,
        EntityManagerInterface $entityManager,
        Request                $request
    ): Response
    {


        $promo = new Promotion();
        $formPromotion = $this->createForm(PromotionType::class, $promo);
        $formPromotion->handleRequest($request);
        $email = $this->getUser()->getUserIdentifier();
        $userConnecte = $adminRepository->findOneBy(['email' => $email]);
        $promo->setCdsPromo($userConnecte);

        if ($formPromotion->isSubmitted()) {

            $entityManager->persist($promo);
            $entityManager->flush();
            return $this->redirectToRoute('decompte_index');

        }

        return $this->renderForm('decompte_rationnaire/mespromotions.html.twig', compact('formPromotion')

        );
    }

    #[Route('/dateRepas/{promo}/{semaine}', name: 'ajoutDate_dateRepas')]
    public function ajoutDate(
        Request                $request,
        EntityManagerInterface $entityManager,
        Promotion              $promo,
        int                    $semaine
    ): Response
    {
        $repas = new Repas();
        $repas->setNbMangeantMidi($promo->getNbStagiaire());
        $repas->setNbMangeantSoir(0);
        $formRepas = $this->createForm(RepasType::class, $repas);


        $formRepas->handleRequest($request);

        if ($formRepas->isSubmitted()) {
            if ($repas->getNbMangeantMidi() > $promo->getNbStagiaire() || $repas->getNbMangeantSoir() > $promo->getNbStagiaire()) {
                $this->addFlash('message', "Le nombre de mangeant ne peut pas etre supérieur au nombre d'eleves !⚠️");
                return $this->redirectToRoute('ajoutDate_dateRepas', ['promo' => $promo->getId(), 'semaine' => $semaine]);
            } else {
                $repas->setNomStage($promo->getNomPromotion());
                $repas->setSemaine($semaine);

                $entityManager->persist($repas);
                $entityManager->flush();
                return $this->redirectToRoute('decompte_index');
            }
        }
        {

            return $this->renderForm('decompte_rationnaire/dateRepas.html.twig', compact('formRepas', 'promo', 'repas', 'semaine'));
        }
    }
}


