<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\CommandeFournisseur;
use App\Entity\ControleQualite;
use App\Entity\Fournisseur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Entity\User;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\CommandeClient;

class AppFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this ->encoder =$encoder;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $generator = Faker\Factory::create("fr_FR");

        $clientArr = array();

        $commandeCliArr = array();


        for($i=0; $i<40; $i++){


            /*
             * declaration des nouvelles instances a creer aléatoirement
             */
            $user = new User();
            $client =new Client();
            $commandeCli =new CommandeClient();
            $fournisseur=new Fournisseur();
            $commandeFournisseur=new CommandeFournisseur();
            $cq =new ControleQualite();


            /*
             * generation USERS
             */
            $password = $this->encoder->encodePassword($user,'password');
            $user->setEmail($generator->email)
                ->setPassword($password)
                ->setCodeDroitCommandeClient($generator->randomNumber());
            $manager->persist($user);
            $manager->flush();


            /*
             * generation CLIENT
             */
            $client->setAdresse($generator->address)
                ->setCodePostal($generator->postcode)
                ->setNom($generator->company)
                ->setNumTel($generator->phoneNumber)
                ->setVille($generator->country);
            $clientArr[] = $client;

            $manager->persist($client);
            $manager->flush();



            /*
             * generation COMMANDE CLIENT
             */
            $commandeCli->setClient($clientArr[$i])
                ->setDateCommandeClient($generator->dateTime)
                ->setDateLivraisonClient($generator->dateTime)
                ->setBonCommandeClient($generator->randomNumber())
                ->setNumFacture($generator->randomNumber())
                ->setDateLivraisonDemandeeParClient($generator->dateTime())
                ->setDateDeReglement($generator->dateTime)
                ->setActive(true);
            $commandeCliArr[] = $commandeCli;
            $manager->persist($commandeCli);
            $manager->flush();



            /*
             * generation FOURNISSEUR
             */
            $fournisseur->setNom($generator->name)
                ->setTel($generator->phoneNumber);




            /*
             * generation COMMANDE FOURNISSEUR
             */
           $commandeFournisseur->setBonCommandeFournisseur($generator->randomNumber())
                                ->setCommandeClient($commandeCliArr[$i])
                                ->setDateBonCommande($generator->dateTime)
                                ->setDateLivraisonDonnee(($generator->dateTime))
                                ->setFournisseur($fournisseur);

            $manager->persist($commandeFournisseur);
            $manager->flush();

            /*
             * generation CQ
             */
            $cq->setCommandeFournisseur($commandeFournisseur)
                ->setDate($generator->dateTime)
                ->setNumControle($generator->randomNumber());
            $manager->persist($cq);
            $manager->flush();
        }


    }
}
