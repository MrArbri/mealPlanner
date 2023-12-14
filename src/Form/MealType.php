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

class MealType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Please enter meal name'],
            ])
            ->add('picture', null, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Please enter the image URL'],
            ])
            ->add('ingredients', null, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Please enter the ingredients'],
            ])
            // ->add('creator', EntityType::class, [
            //     // looks for choices from this entity
            //     'class' => User::class,

            //     // uses the User.username property as the visible option string
            //     'choice_label' => 'creator',

            //     // used to render a select box, check boxes or radios
            //     // 'multiple' => true,
            //     // 'expanded' => true,
            // ])
            ->add('preparation', null, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Please enter the preparation steps'],
            ])
            ->add('prep_time', null, [
                'attr' => ['class' => 'form-control'],
                "widget" => "single_text"
            ])
            ->add('rating', ChoiceType::class, [
                'attr' => ['class' => 'form-control'],
                'choices'  => [
                    '⭐️' => '1',
                    '⭐️⭐️' => '2',
                    '⭐️⭐️⭐️' => '3',
                    '⭐️⭐️⭐️⭐️' => '4',
                    '⭐️⭐️⭐️⭐️⭐️' => '5',
                ],
            ])
            ->add('description', null, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Please describe the meal'],
            ])
            ->add('calories', NumberType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'ex. 250'],
                "constraints" => [
                    new Range([
                        'min' => 1,
                        'max' => 1000,
                        'notInRangeMessage' => "The calories can not be higher than 1000"
                    ]),
                ]
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
