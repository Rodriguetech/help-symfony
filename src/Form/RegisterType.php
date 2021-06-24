<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Votre nom',
                'required' => true,
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30
                ]),
                'attr' => [
                    'placeholder' => 'Entrez votre nom',
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Votre prénom',
                'required' => true,
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30
                ]),
                'attr' => [
                    'placeholder' => 'Entrez votre prénom',
                    'class' => 'form-label'
                ]
            ])




            ->add('email', EmailType::class, [
                'label' => 'Votre email',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez votre email'
                ]
            ])

            ->add('phone', TextType::class, [
                'label' => 'Votre numéro de téléphone ',
                'required' => true,
                'attr' => [
                    'placeholder' => '+229 .....',
                    'class' => 'form-label'
                ]
            ])

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identique.',
                'label' => 'Votre mot de passe',
                'required' => true,
                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => [
                        'placeholder' => '***********',
                        'class' => 'form-control mb-3'
                    ]
                ],
                'second_options' => [
                    'label' => 'Retaper votre mot de passe',
                    'attr' => [
                        'placeholder' => '***********',
                        'class' => 'form-control'
                    ]
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire",
                'attr' => [
                    'class' => 'btn btn-primary btn-lg rounded-pill w-100'
                ]
            ])
        ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
