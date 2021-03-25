<?php

namespace App\Controller;
use DateTime;

use App\Entity\CommandeFournisseur;
use App\Repository\CommandeClientRepository;
use App\Repository\CommandeFournisseurRepository;
use App\Repository\ControleQualiteRepository;
use App\Controller\Email;
use App\Repository\TestClassRepository;
use App\Repository\UserRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashBoardController extends AbstractController
{


    /**
     * @Route("/dashBoard", name="dash_board")
     * @param CommandeClientRepository $comCliRepo
     * @param CommandeFournisseurRepository $comFourRepo
     * @param ControleQualiteRepository $controleQualiteRepository
     * @return Response
     */
    public function index(CommandeClientRepository $comCliRepo, CommandeFournisseurRepository $comFourRepo, ControleQualiteRepository $controleQualiteRepository, Request $request): Response
    {

        $comCli = $comCliRepo->findAllActive();
        foreach ($comCli as $uneComCli){
            $arrComFour =$comFourRepo->findByComCli($uneComCli->getId());
            foreach ($arrComFour as $uneComFour){
                $cqs = $controleQualiteRepository->findByComFour($uneComFour->getId());
                foreach ($cqs as $cq)
                $uneComFour->setControleQualite($cq);
                $uneComCli->addCommandeFournisseur($uneComFour);

            }

        }


        return $this->render('dash_board/index.html.twig', [
            'comCli' => $comCli
        ]);
    }

    /**
     * @Route ("/dashFournisseur/{id}", name="dashFour")
     */
    public function commandeFournisseur( $id ,CommandeFournisseurRepository $comFourRepo){

        $arrComFour =$comFourRepo->findByComCli($id);
        return $this->render('dash_board/CommandeFournisseur.html.twig',['comFour'=>$arrComFour]);
    }

    /**
     * @Route ("/dashFournisseurTest", name="dashFourTest")
     * @param TestClassRepository $repoTest
     * @param UserRepository $repoUser
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function dashTest(TestClassRepository $repoTest,UserRepository $repoUser, Request $request,EntityManagerInterface $entityManager){

        /*
         * tableau des get
         */

        $test =$repoTest->findAll();
        foreach ($test as $unTest){
            $postFormX[]=["x",$unTest->getId()];
        }
        foreach ($test as $unTest){
            $postFormY[]="y".$unTest->getId();
        }
        foreach ($test as $unTest){
            $postFormZ[]="z".$unTest->getId();
        }
        foreach ($test as $unTest){
            $postFormA[]="a".$unTest->getId();
        }
        $arrayChampAPersiste= array();
        foreach ($postFormX as $unForm){
            $id = $unForm[1];

            foreach ($test as $unTest){
                if($id == $unTest->getId()){
                    $resultFormulaire =$request->request->get('x'.(string)$unForm[1]);
                    dump($resultFormulaire);
                    if (($resultFormulaire!=$unTest->getX() && $resultFormulaire!="")||($resultFormulaire=="" && $unTest->getX() =="")){
                        $unTest->setX($resultFormulaire);
                        $arrayChampAPersiste[]=$unTest;

                    }

                }
            }

        }
        foreach ($postFormY as $unForm){
            $id = $unForm[1];
            foreach ($test as $unTest){
                if($id == $unTest->getId()){
                    $resultFormulaire =$request->request->get($unForm);
                    if (($resultFormulaire!=$unTest->getY() && $resultFormulaire!="")||($resultFormulaire!="" && $unTest->getY() =="")){
                        $unTest->setY($resultFormulaire);
                        $arrayChampAPersiste[]=$unTest;

                    }
                }
            }

        }
        foreach ($postFormZ as $unForm){
            $id = $unForm[1];
            foreach ($test as $unTest){
                if($id == $unTest->getId()){
                    $resultFormulaire =$request->request->get($unForm);
                    if (($resultFormulaire!=$unTest->getZ() && $resultFormulaire!="")||($resultFormulaire!="" && $unTest->getZ() =="")){
                        $unTest->setZ($resultFormulaire);
                        $arrayChampAPersiste[]=$unTest;

                    }

                }
            }

        }
        foreach ($postFormA as $unForm){
            $id = $unForm[1];
            foreach ($test as $unTest){
                if($id == $unTest->getId()){
                    $resultFormulaire =$request->request->get($unForm);
                    if (($resultFormulaire!=$unTest->getA() && $resultFormulaire!="")||($resultFormulaire!="" && $unTest->getA()->format('Y-m-d') =="")){
                        $dateTime =new DateTime($resultFormulaire);


                        $unTest->setA($dateTime);
                        $arrayChampAPersiste[]=$unTest;

                    }
                }
            }

        }
        foreach ($arrayChampAPersiste as $unChampAPersiste){
            $entityManager->persist($unChampAPersiste);

        }


        $entityManager->flush();


        $email =$this->getUser()->getUsername();

        $user = $repoUser->findByUsername($email);
        $codeString=$user->decriptionCodeTest($user->getCodeDroitTest());
        $codeArray = $user->controleCode($codeString);













        return $this->render('dash_board/dashTest.html.twig',['Tests'=>$test ,'droits'=>$codeArray]);

    }
}
