<?php

namespace App\Form;

// use DateTime;
use DateInterval;
use App\Entity\Post;
// use DateTimeInterface;
use Symfony\Component\Form\AbstractType;
// use Eckinox\TinymceBundle\Form\Type\TinymceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $today = new \DateTime();
        $tomorrow = $today->add(new DateInterval('P1D'));
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
                    'attr' => [
                        'min' => $tomorrow->format('Y-m-d'),
                    ],
                    // 'data' => [
                    //     'time' => [
                    //         'second' => '0'
                    //     ]
                    // ]
                ]
            )
            ->add(
                'information',
                TextareaType::class,
                // [
                //     'attr' => [
                // "toolbar" => "bold italic underline | bullist numlist",
                //         'class' => 'form-control'
                //     ]
                // ]
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
