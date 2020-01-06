<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/hello/{prenom}/age/{age}", name="hello")
     * @Route("/hello", name="hello_base")
     * @Route("/hello/{prenom}", name="hello_prenom")
     * @param string $prenom
     * @param int $age
     * @return Response
     */
    public function hello($prenom = "anonyme", $age = 0)
    {
        return $this->render('home/hello.html.twig', [
            'prenom' => $prenom,
            'age' => $age
        ]);
    }
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $prenoms = ["Lior", "Joseph", "Anne"];
        return $this->render(
            'home/index.html.twig',
            [
                'title' => "Bonjour",
                'age' => 17,
                "prenoms" => $prenoms
            ]
        );
    }
}
