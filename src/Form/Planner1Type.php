<?php

namespace App\Form;

use App\Entity\Meal;
use App\Entity\Planner;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Planner1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('time', ChoiceType::class, [
                'choices' => [
                    'Breakfast' => 'Breakfast',
                    'Lunch' => 'Lunch',
                    'Dinner' => 'Dinner'
                ]
            ])
            ->add('day', ChoiceType::class, [
                'choices' => [
                    'Today' => 'Today',
                    'Monday' => 'Monday', 
                    'Tuesday' => 'Tuesday', 
                    'Wednesday' => 'Wednesday', 
                    'Thursday' => 'Thursday', 
                    'Friday' => 'Friday', 
                    'Saturday' => 'Saturday', 
                    'Sunday' => 'Sunday', 
                ]
            ])
//             ->add('fk_user', EntityType::class, [
//                 'class' => User::class,
// 'choice_label' => 'username',
//             ])
//             ->add('fk_meal', EntityType::class, [
//                 'class' => Meal::class,
// 'choice_label' => 'name',
//             ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Planner::class,
        ]);
    }
}
