<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Feature;
use App\Entity\FeatureValue;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FeatureValueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('feature', EntityType::class, [
                'label' => 'Caractéristique',
                'class' => Feature::class,
                'choice_label' => 'name'
            ])
            ->add('value', TextType::class, [
                'label' => 'Valeur',
                'empty_data' => '',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('data_class', FeatureValue::class);
    }
}
