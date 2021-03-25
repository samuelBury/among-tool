<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreerEntiteController extends AbstractController
{
    /**
     * @Route("/creer/entite", name="creer_entite")
     */
    public function index(): Response
    {



        return $this->render('creer_entite/index.html.twig', [
            'controller_name' => 'CreerEntiteController',
        ]);
    }
}
