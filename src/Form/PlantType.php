<?php

namespace App\Form;

use App\Entity\Plant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('minNumberOfDaysToWater')
            ->add('maxNumberOfDaysToWater')
            ->add('fertilizers', ChoiceType::class, [
                'choices' => [
                    'NPK' => 'NPK',
                    'Compost' => 'Compost',
                    'Manure' => 'Manure',
                    'Organic mix' => 'Organic mix',
                ],
                'multiple' => true,   // щоб повертало масив
                'expanded' => false,  // false = select, true = checkboxes
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plant::class,
        ]);
    }
}
