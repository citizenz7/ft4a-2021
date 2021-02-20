<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Licences;
use App\Entity\Torrents;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TorrentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Title',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            //->add('slug')
            ->add('hash', TextType::class, [
                'label' => 'Torrent hash',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('link', UrlType::class, [
                'label' => 'Link',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('content', CKEditorType::class)
            ->add('size', TextType::class, [
                'label' => 'Torrent size',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            //->add('date')
            ->add('torrentFile', TextType::class, [
                'label' => 'Torrent file',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('image', TextType::class, [
                'label' => 'Torrent image',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            //->add('views')
            //->add('author')
            ->add('category', EntityType::class, [
                'class' => Categories::class,
                'choice_label' => 'title',
                'multiple' => true,
                'attr' => [
                    'class' => 'form-control'
                ]
                ])
            ->add('licence', EntityType::class, [
                'class' =>Licences::class,
                'choice_label' => 'title',
                'multiple' => true,
                'attr' => [
                    'class' => 'form-control'
                ]
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
