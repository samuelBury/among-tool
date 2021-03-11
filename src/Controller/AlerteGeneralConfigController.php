<?php

namespace App\Controller;

use App\Entity\Alarme;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlerteGeneralConfigController extends AbstractController
{
    /**
     * @Route("/alerte/general/config", name="alerte_general_config")
     * @param UserRepository $userRepo
     * @param Request $request
     * @return Response
     */
    public function index(UserRepository $userRepo, Request $request, EntityManagerInterface $em): Response
    {
        $users = $userRepo->findAll();

        $alarme = new Alarme();
        if (null!==$request->request->get('colonneApplication')&&
            null!==$request->request->get('colonneControle')&&
            null!==$request->request->get('delai1')&&
            null!==$request->request->get('delai2')&&
            null!==$request->request->get('delai3')&&
            (null!==$request->request->get('profil')||null!==$request->request->get('user0'))){

            $alarme->setChampApplication($request->request->get("colonneApplication"));
            $alarme->setChampControle($request->request->get('colonneControle'));
            $alarme->setDelai1($request->request->get('delai1'));
            $alarme->setDelai2($request->request->get('delai2'));
            $alarme->setDelai3($request->request->get('delai3'));
            if (null!==$request->request->get('profil')){
                $roles[]= $request->request->get('profil');
                $alarme->setRole($roles);
            }
            $i = 0;
            while(null!==$request->request->get('user'.(string)$i)){
                dump($request->request->get('user'.(string)$i));

                $user = $userRepo->findById((int)$request->request->get('user'.(string)$i));
                $alarme->addUser($user);
                $i++;
            }
            $em->persist($alarme);
            $em->flush();
        }



            dump($alarme);




        return $this->render('alerte_general_config/index.html.twig', [
            'users' => $users,
        ]);
    }
}
