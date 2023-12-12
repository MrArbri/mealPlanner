<?php

namespace App\Form;

use App\Entity\Meal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ->add('calories', ChoiceType::class, [
                'attr' => ['class' => 'form-control'],
                'choices'  => [
                    'low 200-299' => '200-299',
                    'medium 300-399' => '300-399',
                    'medium 400-499' => '400-499',
                    'high 500-599' => '500-599',
                    'high 600-699' => '600-699',
                    'high 700-850' => '700-850',
                ],
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
