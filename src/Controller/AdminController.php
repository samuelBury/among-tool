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
        $arrayDroit= array(
            ["droit lecture CLIENT :", "clientRead",1],
            ["droit ecriture CLIENT :","clientWrite",3],
            ["droit lecture DATE COMMANDE :","dateDeLaCommandeRead",1],
            ["droit ecriture DATE COMMANDE :","dateDeLaCommandeWrite",3],
            ["droit suppretion DATE CLIENT :","dateDeLaCommandeDelete",5],
            ["droit lecture NUM COMMANDE CLIENT :","numCommandeClientRead",1],
            ["droit ecriture NUM COMMANDE CLIENT :","numCommandeClientWrite",3],
            ["droit suppretion NUM COMMANDE CLIENT :","numCommandeClientDelete",5],
            ["droit lecture DOCUMENT CLIENT :","DocumentClientRead",1],
            ["droit ecriture DOCUMENT CLIENT :","DocumentClientWrite",3],
            ["droit suppretion DOCUMENT CLIENT :","DocumentClientDelete",5],
            ["droit impretion DOCUMENT CLIENT :","DocumentClientPrint",7],
            ["droit lecture DATE LIVRAISON PREVU","dateLivraisonClientPrevuRead",1],
            ["droit ecriture DATE LIVRAISON PREVU","dateLivraisonClientPrevuWrite",3],
            ["droit suppretion DATE LIVRAISON PREVU","dateLivraisonClientPrevuDelete",5],
            ["droit lecture DATE REGLEMENT","dateReglementFactureRead",1],
            ["droit ecriture DATE REGLEMENT","dateReglementFactureWrite",3],
            ["droit suppretion DATE REGLEMENT","dateReglementFactureDelete",5]);


        $cumule = array(0,0,0,0,0,0);

        for($i =0, $iMax = count($arrayDroit); $i< $iMax; ++$i){





            if (isset($_POST[$arrayDroit[$i][1]])) {
                if ($i <2){
                    $cumule[0]+=$arrayDroit[$i][2];
                }
                if ($i>1 and $i<5){
                    $cumule[1]+=$arrayDroit[$i][2];
                }
                if ($i>4 and $i<8){
                    $cumule[2]+=$arrayDroit[$i][2];
                }
                if ($i>7 and $i<12){
                    $cumule[3]+=$arrayDroit[$i][2];
                }
                if ($i>11 and $i<15){
                    $cumule[4]+=$arrayDroit[$i][2];
                }
                if ($i>14 and $i<18){
                    $cumule[5]+=$arrayDroit[$i][2];
                }





            }

        }


        $codeDroit = implode(",",$cumule)       ;
        echo $codeDroit                          ;
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

