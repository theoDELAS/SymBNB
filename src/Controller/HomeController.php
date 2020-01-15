<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $prenoms = ["Lior", "Joseph", "Anne"];
        return $this->render(
            'home.html.twig',
            [
                'title' => "Bonjour",
                'age' => 17,
                "prenoms" => $prenoms
            ]
        );
    }
}
