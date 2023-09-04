<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Eckinox\TinymceBundle\Form\Type\TinymceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

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
                DateTimeType::class,
                [
                    // 'widget' => 'single_text',
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'dateCreation',
                HiddenType::class,
                [
                    // 'format' => 'YYYY-mm-dd HH:ii:ss',
                    'data' => $dt->format('Y-m-d H:i:s'),
                ]
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
                HiddenType::class, [
                    'data'  => 'A faire',
                ]);
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
