<?php

namespace App\Form;

use App\Entity\Meal;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;

class PlannerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('creator', EntityType::class, [
                // looks for choices from this entity
                'class' => User::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'creator',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
            ->add('type', ChoiceType::class, [
                'attr' => ['class' => 'form-control'],
                'choices'  => [
                    'Vegan' => 'Vegan',
                    'Vegetarian' => 'Vegetarian',
                    'Non Vegetarian/Vegan' => 'Non Vegetarian/Vegan',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Meal::class,
        ]);
    }
}