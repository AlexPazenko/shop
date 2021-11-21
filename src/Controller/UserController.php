<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Entity\User;

class UserController extends AbstractController
{
    /**
     * @Route("/users", name="users")
     */
    public function index(): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        if (!$users) {
          return new Response('Sorry, no users yet!!!');
        } else {
           return $this->render('user/index.html.twig', [
               'controller_name' => 'UserController',
               'users' => $users,
           ]);
        }
    }
}