<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Fournisseur;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ClientType;
use App\Form\FournisseurType;


class AdminController extends AbstractController
{
    /**
     * @Route("/admin/createUser", name="create_user")
     *
     */
    public function createUser(): Response
    {
        $user = new User();





        return $this->render('admin/createUser.html.twig');
    }

    /**
     * @return Response
     * @Route ("aaaa" , name="aa")
     */
    public function add(){
        return $this->render('admin/createCustomer.html.twig');
    }

    /**
     * @return Response
     * @Route ("admin/createCustomer", name="create_customer")
     */
    public function createCustomer(EntityManagerInterface $entityManager, Request $request): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $client = $form->getData();
            $entityManager->persist($client);
            $entityManager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('admin/createCustomer.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @Route ("admin/createProvider", name="create_provider")
     */
    public function createProvider(EntityManagerInterface $entityManager, Request $request)
    {
        $fournisseur = new Fournisseur();
        $form = $this->createForm(FournisseurType::class, $fournisseur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $fournisseur = $form->getData();
            $entityManager->persist($fournisseur);
            $entityManager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('admin/createProvider.html.twig', [
            'form' => $form->createView()
        ]);
    }

}

