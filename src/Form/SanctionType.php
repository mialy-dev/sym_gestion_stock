<?php

namespace App\Form;

use App\Entity\Tsanction;
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
        ->add(
            'date_sanction',
            DateType::class,
            [
                'label' => 'Date de Sanction : ',
                'attr' => [
                    'class' => 'form-control'
                ]
            ]
        )
        ->add( 'heure_sanction',
                    TimeType::class,[
                        'label' => 'Date de Sanction : ',
                        'attr' => [
                            'class' => 'form-control'
                        ],
                    ]
        )
        ->add( 'duree',
            TextType::class,
            [
                'label' => 'Date de Sanction : ',
                'attr' => [
                    'class' => 'form-control'
                ]
            ] 
        )
        ->add( 'motif',
            TextareaType::class,
            [
                'label' => 'Date de Sanction : ',
                'attr' => [
                    'class' => 'form-control'
                ]
            ] 
        )
        ;
    }

    public function configureOptions( OptionsResolver $resolver ): void {
        $resolver->setDefaults( [
            'data_class' => Tsanction::class,
        ] );
    }
}
