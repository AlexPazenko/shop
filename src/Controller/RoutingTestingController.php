<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;

class RoutingTestingController extends AbstractController
{
    /**
     * @Route ("/blog/{page?1}", name="blog_list", requirements={"page"="\d+"})
     */
    public function list(int $page): Response
    {
        //Example: /blog/5
        return new Response('This is a blog page with id: '. $page);
    }


    /**
     * @Route ({
     *     "nl": "/over-ons",
     *     "en": "/about-us"
     *     }, name="about_us"
     *     )
     */
    public function aboutUs()
    {
        return new Response('Translated routes');
    }


    /**
     * @Route("/api/posts/{id}", methods={"GET","HEAD"})
     */
    public function show(int $id): Response
    {
        return new Response('Translated routes ' . $id);
    }


    /**
     * @Route (
     *
     *     "/articles/{_locale}/{year}/{slug}/{category}",
     *     defaults={"category": "computers", "title": "Hello!"},
     *     requirements={
     *       "_locale": "en|fr",
     *       "category":"computers|rtv",
     *       "year": "\d+"
     *     }, methods={"GET"}
     * )
     */
    public function advancedRout(string $title, int $year, string $category)
    {
        //Example: /articles/en/2020/dell/computers
        return new Response($title . '<br> This is an advanced route.You have specified a ' . $year . ' year in the url. <br> You are in ' . $category .' category.');
    }




    /**
     * @Route("/redirect-test/{name}", name="redirect-test")
     */
    public function redirectTest(string $name)
    {
        //Example: /redirect-test/John
        return $this->redirectToRoute('redirected-to', array('name' => $name));
    }

    /**
     * @Route ("/redirected-to/{name?}", name="redirected-to")
     */
    public function redirectedTo(string $name)
    {
        return new Response('Hello ' . $name. '!');
    }


}
