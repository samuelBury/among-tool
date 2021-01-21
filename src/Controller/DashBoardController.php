<?php

namespace App\Controller;

use App\Repository\CommandeClientRepository;
use App\Repository\CommandeFournisseurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashBoardController extends AbstractController
{

    /**
     * @var CommandeClientRepository
     */
    private $comCliRepo;

    /**
     * @var CommandeFournisseurRepository
     */

    private $comFourRepo;

    /**
     * @Route("/dash/board", name="dash_board")
     */
    public function index(): Response
    {

        $comCli = $this->comCliRepo->findAllActive();

        foreach ($comCli as $uneComCli){
            $range[]= $uneComCli->getId();
        }
        $comFour = $this->comFourRepo->findByComCli($range[]);

        dump($comFour);

        return $this->render('dash_board/index.html.twig', [
            'controller_name' => 'DashBoardController',
        ]);
    }
}
