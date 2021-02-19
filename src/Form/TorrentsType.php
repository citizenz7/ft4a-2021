<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Licences;
use App\Entity\Torrents;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TorrentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('slug')
            ->add('hash')
            ->add('link')
            ->add('content', TextareaType::class)
            ->add('size')
            //->add('date')
            ->add('torrentFile')
            ->add('image')
            //->add('views')
            //->add('author')
            ->add('category', EntityType::class, [
                'class' => Categories::class,
                'choice_label' => 'title',
                'multiple' => true
                ])
            ->add('licence', EntityType::class, [
                'class' =>Licences::class,
                'choice_label' => 'title',
                'multiple' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Torrents::class,
        ]);
    }
}
