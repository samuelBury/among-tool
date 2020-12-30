<?php

namespace App\Controller;


use App\Entity\CommandeFournisseur;
use App\Entity\Fournisseur;
use App\Form\CommandeFournisseurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RespFournController extends AbstractController
{
    /**
     * @Route("/respFourn/providerComAdd", name="resp_fournAdd")
     */
    public function AddCommandeFournisseur(EntityManagerInterface $entityManager, Request $request): Response
    {
        $com = new CommandeFournisseur();
        $form = $this->createForm(CommandeFournisseurType::class, $com);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $com = $form->getData();
            $entityManager->persist($com);
            $entityManager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('respFourn/providerOrderAdd.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
