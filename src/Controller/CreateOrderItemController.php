<?php

namespace App\Controller;

use App\Entity\OrderItem;
use App\Form\OrderItemFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CreateOrderItemController extends AbstractController
{
    /**
     * @Route("/create/order-item", name="create_order_item")
     */
    public function index(Request $request): Response
    {
        $orderItem = new OrderItem();
        $form = $this->createForm(OrderItemFormType::class, $orderItem);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {

            $orderItem->setOrderid($form->get('orderid')->getData());
            $orderItem->setProduct($form->get('product')->getData());
            $orderItem->setAmount($form->get('amount')->getData());
            $orderItem->setDescription($form->get('description')->getData());


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($orderItem);
            $entityManager->flush();

        }
        return $this->render('create_order_item/index.html.twig', [
            'controller_name' => 'CreateOrderItemController',
            'form' => $form->createView(),
        ]);
    }
}
