<?php

namespace App\Form;

use App\Entity\Invite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class InviteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Votre email',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez votre email'
                ]
            ])

            ->add('submit', SubmitType::class, [
                'label' => "Invité maintenant",
                'attr' => [
                    'class' => 'btn btn-primary btn-lg rounded-pill w-100'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Invite::class,
        ]);
    }
}
