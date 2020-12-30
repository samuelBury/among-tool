<?php

namespace App\Form;


use App\Entity\CommandeClient;
use App\Entity\CommandeFournisseur;
use App\Entity\Fournisseur;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeFournisseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bonCommandeFournisseur',TextType::class)
            ->add('dateBonCommande',DateType::class)
            ->add('dateLivraisonDonnee',DateType::class)
            ->add('commandeClient',EntityType::class,[
                'class'=>CommandeClient::class,
                'choice_label'=>'bonCommandeClient',
                'query_builder'=>function(EntityRepository $repo){
                    return $repo->createQueryBuilder('s');
                }
            ])
            ->add('fournisseur',EntityType::class,[
                'class'=>Fournisseur::class,
                'choice_label'=>'nom',
                'query_builder'=>function(EntityRepository $repos){
                    return $repos->createQueryBuilder('s');
                }
            ])
            ->add('save', SubmitType::class, ['label' => 'Ajouter une commande fournisseur'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CommandeFournisseur::class,
        ]);
    }
}
