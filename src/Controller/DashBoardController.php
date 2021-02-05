<?php

namespace App\Controller;

use App\Entity\CommandeFournisseur;
use App\Repository\CommandeClientRepository;
use App\Repository\CommandeFournisseurRepository;
use App\Repository\ControleQualiteRepository;
use App\Controller\Email;
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
}
