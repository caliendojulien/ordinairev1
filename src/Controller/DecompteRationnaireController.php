<?php

namespace App\Controller;

use App\Entity\Stages;
use App\Form\DetailStageType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DecompteRationnaireController extends AbstractController
{
    #[Route('/decompte', name: 'index_decompte')]
    public function index(): Response
    {

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

            ]
        );
    }

    #[Route('/decompte-detail/{id}', name: 'update_decompte')]
    public function update(
        ManagerRegistry $update,
                        $id,
        Request         $request
    ): Response
    {

        $entityManager = $update->getManager();
        $detail = $entityManager->getRepository(Stages::class)->find($id);
        $formDetail = $this->createForm(DetailStageType::class, $detail);
        $formDetail->handleRequest($request);


        if ($formDetail->isSubmitted()) {
            $entityManager->persist($detail);
            $entityManager->flush();
            dump($formDetail);
            return $this->redirectToRoute('index_decompte');
        }

        return $this->renderForm('decompte_rationnaire/decompte_detail.html.twig', compact('formDetail')

        );
    }
}
