<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateOrderController extends AbstractController
{
    /**
     * @Route("/create/order", name="create_order")
     */
    public function index(Request $request): Response
    {
        $order = new Order();
        $form = $this->createForm(OrderFormType::class, $order);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {

            $order->setSalesman($form->get('salesman')->getData());
            $order->setPaid($form->get('paid')->getData());
            $order->setDescription($form->get('description')->getData());
            $order->setDate(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($order);
            $entityManager->flush();

        }
        return $this->render('create_order/index.html.twig', [
            'controller_name' => 'CreateOrderController',
            'form' => $form->createView(),
        ]);
    }
}
