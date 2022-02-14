<?php

namespace App\Form;

use App\Entity\Agent;
use App\Entity\Mission;
use App\Entity\Speciality;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('description', TextareaType::class)
            ->add('code', TextType::class)
            ->add('country', ChoiceType::class, [
                'choices' => [
                    'France' => 'France',
                    'Chine' => 'Chine',
                    'Allemagne' => 'Allemagne',
                    'Russie' => 'Russie',
                    'UK' => 'UK',
                    'USA' => 'USA',
                ]
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Assassinat' => 'Assassinat',
                    'Exfiltration' => 'Exfiltration',
                    'Enlèvement' => 'Enlèvement',
                    'Infiltration' => 'Infiltration',
                    'Sauvetage' => 'Sauvetage',
                    'Surveillance' => 'Surveillance',
                    'Vol' => 'Vol',
                ]
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'En préparation' => 'En préparation',
                    'En cours' => 'En cours',
                    'Terminé' => 'Terminé',
                    'Echec' => 'Echec',
                ]
            ])
            ->add('dateStart', DateType::class,[
                'widget' => 'choice',
                'format' => 'd-M-y',
                'years' => range(date("Y"), date("Y") + 100)
            ])
            ->add('dateEnd', DateType::class,[
                'widget' => 'choice',
                'format' => 'd-M-y',
                'years' => range(date("Y"), date("Y") + 100)
            ])
            ->add('agent', EntityType::class, [
                'choice_label' => 'lastname',
                'class' => Agent::class,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('speciality', EntityType::class, [
                'choice_label' => 'name',
                'class' => Speciality::class,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mission::class,
        ]);
    }

}
