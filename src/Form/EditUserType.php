<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email' , EmailType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => "Entrer votre adresse email"
                    ])
                ],
                'required' => true,
                'attr' => [
                    'class' => ''
                ]
            ])
            ->add('roles' , ChoiceType::class, [
                'choices' =>[
                    'Client' => 'ROLE_CLIENT',
                    'Developpeur' => 'ROLE_DEV',
                    'Chef projet' => 'ROLE_CHEF',
                    'Administrateur' => 'ROLE_ADMIN',
                ],
                'expanded' => true,
                'multiple' => true,
                'label' => false,
                 'attr' => [
                 'class' => 'd-flex justify-content-between'
                 ]
            ])

            ->add('valider', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary  rounded-pill w-100'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
