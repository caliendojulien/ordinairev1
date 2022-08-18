<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/ajouter', name: 'app_ajouter')]
    #[IsGranted ('ROLE_USER')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new Admin();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        $user->setPassword('$2y$13$77JKGUeSnDHXgVyBLXkdQeYuoTDOCHMrDltXTBlXeD2XV0/usZWo2');


        dump($user);

        if ($form->isSubmitted()) {
            // encode the plain password

            dump("ok");
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_ajouter');
        }

        return $this->render('ajouter_stagiaire/ajouter.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
