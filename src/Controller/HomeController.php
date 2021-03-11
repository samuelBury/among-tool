<?php

namespace App\Controller;

use App\Entity\Alarme;
use App\Repository\AlarmeRepository;
use App\Repository\AlerteRepository;
use App\Repository\TestClassRepository;
use App\Repository\UserRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @throws \Exception
     */
    public function index(UserRepository $repository, TestClassRepository $testRepo, AlarmeRepository $alarmeRepo): Response
    {

        $auth = $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');


        $nomChamp = ["a", "x", "y", "z"];
        dump('0');

        foreach ($nomChamp as $unChamp) {
            $alarmes = $alarmeRepo->findAll();
            foreach ($alarmes as $alarme) {
                if ($alarme->getChampApplication() == $unChamp) {
                    $users = $alarme->getUsers();
                    dump('1');
                    foreach ($users as $user) {
                        if ($user->getUsername() == $this->getUser()->getUsername()) {
                            $tests = $testRepo->findAll();
                            dump('2');
                            foreach ($tests as $test) {
                                dump($test->trouverChampApplication($alarme->getChampApplication()));
                                if ($test->trouverChampApplication($alarme->getChampApplication()) == null) {
                                    dump("3");
                                    $dateJour = new DateTime(date("Y-m-d H:i:s"));
                                    $tempRestant = $test->trouverChampApplication($alarme->getChampControle())->diff($dateJour, false);
                                    $tempRestantJour = $tempRestant->d;

                                    $alerte = new Alerte();
                                    $message = "c'est un message il vous reste " . (string)$tempRestantJour . " jour pour remplir le champ : " . (string)$alarme->getChampControle() . " de la ligne : " . (string)$test->getId();
                                    $alerte->setMessage($message);
                                    dump($message);
                                    if ($tempRestantJour < $alarme->getDelai1() && $tempRestantJour > $alarme->getDelai2()) {
                                        $color = 'warning';
                                        $alerte->setColor($color);
                                        dump('delai1');
                                    }
                                    if ($tempRestantJour < $alarme->getDelai2() && $tempRestantJour > $alarme->getDelai3()) {
                                        $color = 'warning';
                                        $alerte->setColor($color);
                                        dump('delai2');
                                    }
                                    if ($tempRestantJour < $alarme->getDelai3()) {
                                        $color = 'danger';
                                        $alerte->setColor($color);
                                        dump('delai3');
                                    }
                                    dump($alerte);
                                    $alertes[]=$alerte;

                                }

                            }
                        }
                    }
                }
            }
        }




        return $this->render('home/index.html.twig', ['alertes'=>$alertes,

        ]);
    }

}