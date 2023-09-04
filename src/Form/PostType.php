<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Eckinox\TinymceBundle\Form\Type\TinymceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $dt = new \DateTime();
        $builder
            ->add(
                'titre',
                TextType::class,
                [
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'dateLimite',
                DateType::class,
                [
                    'widget' => 'single_text',
                    // 'attr' => [
                    //     'class' => 'form-control'
                    // ],
                    // 'data' => [
                    //     'time' => [
                    //         'second' => '0'
                    //     ]
                    // ]
                ]
            )
            ->add(
                'dateCreation',
                DateType::class,
                // [
                //     'data' => $dt,
                // ]
            )
            ->add(
                'information',
                TinymceType::class,
                [
                    'attr' => [
                        "toolbar" => "bold italic underline | bullist numlist",
                    ]
                ]
            )
            ->add(
                'etat',
                HiddenType::class,
                [
                    'data'  => 'A faire',
                ]
            )
            ->add(
                'valider',
                SubmitType::class,
                [
                    'attr' => [
                        'class' => 'btn btn-success'
                    ]
                ]
            );
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
            'data_class' => Post::class,
            ]
        );
    }
}
