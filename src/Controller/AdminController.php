<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Fournisseur;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;


use Symfony\Component\HttpFoundation\Response;


use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ClientType;
use App\Form\FournisseurType;



class AdminController extends AbstractController
{
    /**
     * @Route("/admin/createUser", name="create_user")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param $mailer
     * @return Response
     */
    public function createUser(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {

        /*
         * init de plein de truc
         */

        $user = new User();
        $emails =$request->request->get('email');
        $mailObject = "Among-tool password";
        $mailMessage = "Votre mot de passe pour acceder à votre espace Among-tool est : ";
        $mailMessage2 = " Vous pourrez ensuite changer votre mot de passe depuis votre espace";


        /*
         * recuperation du formulaire de droit
         */
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
            ["droit suppretion DATE REGLEMENT","dateReglementFactureDelete",5],
            ["droit lecture NUM FACTURE","numFactureRead",1],
            ["droit ecriture NUM FACTURE","numFactureFactureWrite",3],
            ["droit suppretion NUM FACTURE","numFactureFactureDelete",5]);


        $cumule = array(0,0,0,0,0,0,0);


        $i=0;
        foreach ($arrayDroit as $unDroit){


            if (isset($_POST[$unDroit[1]])) {
                if ($i <2){
                    $cumule[0]+=$unDroit[2];
                }
                if ($i>1 && $i<5){
                    $cumule[1]+=$unDroit[2];
                }
                if ($i>4 && $i<8){
                    $cumule[2]+=$unDroit[2];
                }
                if ($i>7 && $i<12){
                    $cumule[3]+=$unDroit[2];
                }
                if ($i>11 && $i<15){
                    $cumule[4]+=$unDroit[2];
                }
                if ($i>14 && $i<18){
                    $cumule[5]+=$unDroit[2];
                }
                if ($i>17 ){
                    $cumule[6]+=$unDroit[2];
                }

            }
        $i++;
        }
        $codeDroit = implode(",",$cumule);



        /*
         * recuperation formulaire droit test
         */
        $arrayDroitTest= array(
            ["droit lecture CLIENT :", "xRead",1],
            ["droit ecriture CLIENT :","xWrite",3],
            ["droit ecriture CLIENT :","xDel",5],
            ["droit lecture DATE COMMANDE :","yRead",1],
            ["droit ecriture DATE COMMANDE :","yWrite",3],
            ["droit suppretion DATE CLIENT :","yDel",5],
            ["droit lecture NUM COMMANDE CLIENT :","zRead",1],
            ["droit ecriture NUM COMMANDE CLIENT :","zWrite",3],
            ["droit suppretion NUM COMMANDE CLIENT :","zDel",5],
            ["droit lecture DOCUMENT CLIENT :","aRead",1],
            ["droit ecriture DOCUMENT CLIENT :","aWrite",3],
            ["droit suppretion DOCUMENT CLIENT :","aDel",5]);





        $cumule = array(0,0,0,0);
        $i=0;
        foreach ($arrayDroitTest as $unDroit){


            if (isset($_POST[$unDroit[1]])) {
                if ($i <3){
                    $cumule[0]+=$unDroit[2];
                }
                if ($i>2 && $i<6){
                    $cumule[1]+=$unDroit[2];
                }
                if ($i>5 && $i<9){
                    $cumule[2]+=$unDroit[2];
                }
                if ($i>8 && $i<12){
                    $cumule[3]+=$unDroit[2];
                }


            }
            $i++;
        }
        $codeDroitTest = implode(",",$cumule);





        $password = "password";
        if (isset($emails)){

            /*
             * creation d'un utilisateur dans la bdd
             */
            $user->setCodeDroitTest($codeDroitTest);
            $user->setEmail($emails);
            $user->setCodeDroitCommandeClient($codeDroit);
            $user->setPassword($password);
            if ($emails!="samy.bury@gmail.com"){
                $entityManager->persist($user);
                $entityManager->flush();
            }


            /*
             * creation
             */

            $email = new Email();
            $email->from("samy.bury@gmail.com")
                ->to($emails)
                ->priority(Email::PRIORITY_HIGH)
                ->subject($mailObject)
                ->text($mailMessage.$password.$mailMessage2)
                ->html('<h1>Lorem ipsum</h1>');
            $mailer->send($email);

            dump($codeDroit);
        }



        dump($request);



        return $this->render('admin/createUser.html.twig');
    }


    /**
     * @param EntityManagerInterface $entityManager
     * @param Request $request
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
     * @return RedirectResponse|Response
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

