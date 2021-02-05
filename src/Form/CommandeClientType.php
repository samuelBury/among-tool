<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\CommandeClient;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CommandeClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bonCommandeClient', TextType::class)
            ->add('dateCommandeClient',DateType::class)
            ->add('dateLivraisonClient',DateType::class)
            ->add('dateLivraisonDemandeeParClient', DateType::class)
            ->add('Client',EntityType::class,[
                'class'=>Client::class,
                'choice_label'=>'nom',
                'query_builder'=>function(EntityRepository $repo){
                return $repo->createQueryBuilder('s');
                }
            ])

        ->add('save', SubmitType::class, ['label' => 'Ajouter une commande client'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CommandeClient::class,
        ]);
    }
}
