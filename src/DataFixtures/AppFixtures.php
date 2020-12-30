<?php

namespace App\DataFixtures;

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

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $generator = Faker\Factory::create("fr_FR");
        for($i=0; $i<5; $i++){
            $user = new User();
            $commandeCli =new CommandeClient();
            $password = $this->encoder->encodePassword($user,'password');
            $user->setEmail($generator->email())
                ->setPassword($password);
            $manager->persist($user);
            $commandeCli->setBonCommandeClient($generator->postcode)
                ->setDateCommandeClient($generator->dateTime)
                ->setDateLivraisonClient($generator->dateTime);
            $manager->persist($commandeCli);
        }
        $manager->flush();
    }
}
