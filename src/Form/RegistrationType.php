<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Add fields to the form
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email Address',
            ])
            ->add('username', TextType::class, [
                'label' => 'Username',
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // Set the data class for the form (the User entity)
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}