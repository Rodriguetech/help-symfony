<?php

namespace App\Form;

use App\Entity\Developpeur;
use App\Entity\Projet;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('nom' , TextType::class,[
                'required' => true,
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30
                ]),
                'attr' => [

                ]

            ])
            ->add('debut' , DateTimeType::class,[
                'attr' => [
                    'class' => ''
                ]
            ])

            ->add('description' , TextareaType::class,[
                'required' => true,
                'attr' => [

                ]

            ])

            ->add('fin')

            ->add('budget' , NumberType::class,[
                'required' => true,
                'attr' => [

                ]
            ] )



            ->add('client' , EntityType::class , [
                'required' => true,
                'multiple' => true,
                'class'  => User::class,

                'query_builder' => function (UserRepository $er){
                    return $er -> createQueryBuilder('u')
                        -> orderBy('u.nom' , 'ASC')
                        ->where('u.roles LIKE :roles')
                        ->setParameter('roles', '%"ROLE_CLIENT"%');
                },
                'choice_label' => 'nom',
            ])

            ->add('developpeur' , EntityType::class , [
                'required' => true,
                'multiple' => true,
                'class'  => User::class,

                    'query_builder' => function (UserRepository $er){
                    return $er -> createQueryBuilder('u')
                        -> orderBy('u.nom' , 'ASC')
                        ->where('u.roles LIKE :roles')
                        ->setParameter('roles', '%"ROLE_DEV"%');
                    },
                    'choice_label' => 'nom',
            ])

            ->add('submit', SubmitType::class, [
                'label' => "Enregistrer",
                'attr' => [
                    'class' => 'btn btn-primary btn-lg  w-100'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
