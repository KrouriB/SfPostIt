<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('dateLimite')
            ->add('dateCreation')
            ->add('information')
<<  << <<< HEAD
            ->add('etat');
=======
            ->add('etat')
        ;
>>>>>>> d895528dfd8ca5352f2dc0406b5fb59360676c0a
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
<<<<<<< HEAD
        $resolver->setDefaults(
            [
            'data_class' => Post::class,
            ]
        );
=======
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
>>>>>>> d895528dfd8ca5352f2dc0406b5fb59360676c0a
    }
}
