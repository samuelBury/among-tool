<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminSystemController extends AbstractController
{
    /**
     * @Route("/creerEntite", name="creerEntite")
     */
    public function index(Request $request, UserRepository $repoUser, EntityManagerInterface $em): Response
    {


        return $this->render('admin_system/index.html.twig', [
            'controller_name' => 'AdminSystemController',
        ]);
    }
}
