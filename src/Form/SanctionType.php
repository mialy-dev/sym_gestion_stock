<?php

namespace App\Form;

use App\Entity\Tetudiant;
use App\Entity\Tsanction;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SanctionType extends AbstractType {
    public function buildForm( FormBuilderInterface $builder, array $options ): void {
        $builder
        ->add('date_sanction',)
        ->add( 'heure_sanction')
        ->add( 'duree')
        ->add( 'motif')
        ->add( 'duree')
        ->add('etudiant',
            EntityType::class,
            [
                'class'=> Tetudiant::class,
                'choice_label'=> 'prenom',
                "attr"=> [
                    "placeholder"=> "Véuillez selectionner un eleve",
                ],
                "multiple" => true,
            ]
        );
        
    }

    public function configureOptions( OptionsResolver $resolver ): void {
        $resolver->setDefaults( [
            'data_class' => Tsanction::class,
        ] );
    }
}
