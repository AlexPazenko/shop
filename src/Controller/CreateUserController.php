<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CreateUserFormType;
use Symfony\Component\HttpFoundation\Request;

class CreateUserController extends AbstractController
{
    /**
     * @Route("/create/user", name="create_user")
     */
    public function index(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(CreateUserFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {

            $user->setEmail($form->get('email')->getData());
            $user->setFirstName($form->get('firstName')->getData());
            $user->setLastName($form->get('lastName')->getData());
            $user->setUserRole($form->get('userRole')->getData());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('users');
        }
        return $this->render('create_user/index.html.twig', [
            'controller_name' => 'CreateUserController',
            'form' => $form->createView(),
        ]);
    }
}
