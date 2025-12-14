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
                    'Biohumus' => 'Biohumus',
                    'Bone meal' => 'Bone meal',
                    'Fish emulsion' => 'Fish emulsion',
                    'Seaweed (Kelp)' => 'Seaweed (Kelp)',
                    'Superphosphate' => 'Superphosphate',
                    'Potassium sulfate' => 'Potassium sulfate',
                ],
                'multiple' => true,
                'expanded' => false,
            ])
            ->add('height')
            ->add('volumeOfWaterInMLperCMofHeight', TextType::class, ['label' => 'Volume of water in ml per cm of height']);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plant::class,
        ]);
    }
}
