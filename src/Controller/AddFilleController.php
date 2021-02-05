<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddFilleController extends AbstractController
{
    /**
     * @Route("/add/fille", name="add_fille")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        if (isset($request->files->all()["fichier"])){
            $file_name =$_FILES["fichier"]["name"];
            $file_name_tmp =$_FILES["fichier"]["tmp_name"];
            $file_dest ='C:/Users/samyb/PhpstormProjects/Among/files/'.$file_name;
            dump($file_name_tmp);
            dump($file_dest);

            dump (move_uploaded_file($file_name_tmp, $file_dest));
        }



        dump($request);
        return $this->render('add_fille/index.html.twig', [
            'controller_name' => 'AddFilleController',
        ]);
    }
}
