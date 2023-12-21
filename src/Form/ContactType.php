<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first_name', null, ['attr' => ['class' => 'form-control', 'placeholder' => 'Please enter your first name'],])

            ->add('last_name', null, ['attr' => ['class' => 'form-control', 'placeholder' => 'Please enter your last name'],])

            ->add('email', null, ['attr' => ['class' => 'form-control', 'placeholder' => 'Please enter your email'],])

            ->add('message', TextareaType::class, ['attr' => ['class' => 'form-control', 'placeholder' => 'Please type your message here'],]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
