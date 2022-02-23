<?php

namespace App\Form;

use App\Entity\Hideout;
use App\Entity\Mission;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HideoutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', TextType::class)
            ->add('address', TextType::class)
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
            ->add('type', TextType::class)
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
            'data_class' => Hideout::class,
        ]);
    }
}
