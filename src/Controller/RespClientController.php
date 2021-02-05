<?php

namespace App\Controller;

use App\Entity\CommandeClient;
use App\Form\CommandeClientEditType;
use App\Repository\CommandeClientRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CommandeClientType;
class RespClientController extends AbstractController
{
    /**
     * @Route("/respClient/customerOrderView", name="customer_orderView")
     */
    public function ListeCommandeClient(CommandeClientRepository $comRepo): Response
    {
        $com = $comRepo->findAllActive();



        return $this->render('respClient/vueCommandeClient.html.twig', [
            'com' => $com,
        ]);
    }




    /**
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @Route ("/respClient/customerOrderAdd", name="customer_orderAdd")
     * @return RedirectResponse|Response
     */
    public function AddCommandeClient(EntityManagerInterface $entityManager, Request $request)
    {

        $com = new CommandeClient();
        $com->setActive(1);
        $form = $this->createForm(CommandeClientType::class, $com);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $com = $form->getData();
            $entityManager->persist($com);
            $entityManager->flush();
            return $this->redirectToRoute('home');
        }
        dump($request);
        return $this->render('respClient/customerOrderAdd.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route ("/respClient/{id}", name="customer_orderEdit")
     * @param CommandeClient $commandeClient
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(CommandeClient $commandeClient, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(CommandeClientEditType::class, $commandeClient);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em->flush();
            return  $this->redirectToRoute('customer_orderView');
        }
        return $this->render('respClient/CommandeClientEdit.html.twig', [
            'com' => $commandeClient,
            'form'=>$form->createView()
        ]);
    }

}
