<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/products", name="products")
     */
    public function index(): Response
    {

        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();

        if (!$products) {
            return new Response('Sorry, no products yet!!!');
        } else {
            return $this->render('product/index.html.twig', [
                'controller_name' => 'ProductController',
                'products' => $products,
            ]);
        }


    }
}
