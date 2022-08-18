<?php

namespace App\Controller;

use App\Entity\Promotion;
use App\Entity\Repas;
use App\Entity\Stages;
use App\Form\PromotionType;
use App\Form\RepasType;
use App\Repository\AdminRepository;
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

        $Lundi = strtotime('next monday +2 weeks');
        $LundiPlus = \DateTime::createFromFormat('d/m/Y', $Lundi);
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
                'LundiPlus' => $LundiPlus

            ]
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

        return $this->renderForm('decompte_rationnaire/mesformations.html.twig', compact('formPromotion')

        );
    }

    #[Route('/dateRepas/{promo}', name: 'ajoutDate_dateRepas')]
    public function ajoutDate(
        Request                $request,
        EntityManagerInterface $entityManager,
        Promotion              $promo


    ): Response
    {
        

        $repas = new Repas();
        $repas->setDate(new \DateTime());
        $repas->setNbMangeantMidi($promo->getNbStagiaire());
        $repas->setNbMangeantSoir(0);
        $formRepas = $this->createForm(RepasType::class, $repas);

        $formRepas->handleRequest($request);

        if ($formRepas->isSubmitted()) {
            $repas->setNomStage($promo->getNomPromotion());

            $entityManager->persist($repas);
            $entityManager->flush();
            return $this->redirectToRoute('decompte_index');
        }

        return $this->renderForm('decompte_rationnaire/dateRepas.html.twig', compact('formRepas', 'promo')

        );
    }
}
