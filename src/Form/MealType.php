<?php

namespace App\Form;

use App\Entity\Meal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class MealType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Please enter the event name'],
            ])
            ->add('picture', null, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Please enter the image URL'],
            ])
            ->add('ingredients', null, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Please enter the ingredients'],
            ])
            ->add('creator', null, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Please enter the your name'],
            ])
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
                'attr' => ['class' => 'form-control', 'placeholder' => 'Please describe the event'],
            ])
            ->add('calories', NumberType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Please describe the event'],
                "constraints" => [
                    new Length([
                        "min" => 100,
                        'minMessage' => 'The calories must be between 100 and 900',
                        "max" => 900,
                    ])
                ]
            ])
            ->add('type', ChoiceType::class, [
                'attr' => ['class' => 'form-control'],
                'choices'  => [
                    'Vegan' => 'vegan',
                    'Vegetarian' => 'vegetarian',
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
