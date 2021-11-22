<?php

namespace App\Controller;

use App\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    /**
     * @Route("/customer-orders/{id}", name="customer")
     */
    public function index(int $id): Response
    {
        $customerOrders = $this->getDoctrine()->getRepository(Customer::class)->findCustomerOrders($id);

        return $this->render('customer/index.html.twig', [
            'controller_name' => 'CustomerController',
            'customerOrders' => $customerOrders,
        ]);
    }
}
