<?php

namespace App\Controller;

use App\Entity\Alerte;
use App\Repository\UserRepository;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AlerteConfigController extends AbstractController
{
    /**
     * @Route("/alerte/config/{nomCol}", name="alerte_config")
     * @param String $nomCol
     * @param UserRepository $repoUser
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function index(String $nomCol, UserRepository $repoUser, Request $request, EntityManagerInterface $em): Response
    {




        $users = $repoUser->findAll();
        foreach ($users as $user){
            $usersName[] = $user->getUsername();
        }
        if (null!==$request->request->get('delai')) {


            $delai = $request->request->get('delai');


            $i = 0;
            $boucle = true;
            while ($boucle) {



                if (null!==$request->request->get('selectUser'.(string)$i)) {
                    $user = $request->request->get('selectUser'.(string)$i);
                    $alerte = new Alerte();
                    $alerte->setNomColonne($nomCol);
                    $alerte->setDelaiEnJour($delai);
                    $alerte->setUser($repoUser->findByUsername($user));
                    $em->persist($alerte);
                    $em->flush();
                    dump($alerte);
                    dump($i);
                } else {
                    $boucle = false;
                }

                $i++;
            }

        }


        return $this->render('alerte_config/index.html.twig', [
            'nomColonne' => $nomCol,'usersName'=>$usersName,
        ]);
    }
}
