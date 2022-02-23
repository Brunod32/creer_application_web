<?php

namespace App\Form;

use App\Entity\Mission;
use App\Entity\Target;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TargetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastName', TextType::class)
            ->add('firstName', TextType::class)
            ->add('dateOfBirth', DateType::class,[
                'widget' => 'choice',
                'format' => 'd-M-y',
                'years' => range(date("Y") - 100, date("Y"))
            ])
            ->add('code', TextType::class)
            ->add('nationality', ChoiceType::class, [
                'choices' => [
                    'France' => 'France',
                    'Chine' => 'Chine',
                    'Allemagne' => 'Allemagne',
                    'Russie' => 'Russie',
                    'UK' => 'UK',
                    'USA' => 'USA',
                ]
            ])
            ->add('mission', EntityType::class, [
                'choice_label' => 'title',
                'class' => Mission::class,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Target::class,
        ]);
    }
}
