<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Licences;
use App\Entity\Torrents;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;

class TorrentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('torrentFile', FileType::class, [
                'label' => 'Fichier torrent',
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'application/x-bittorrent'
                        ],
                        'mimeTypesMessage' => 'Le fichier envoyé n\'est pas valide',
                    ])
                ]
            ])
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => [
                    'class' => 'form-control mb-3'
                ]
            ])
            //->add('slug')
//            ->add('hash', TextType::class, [
//                'label' => 'Torrent hash',
//                'attr' => [
//                    'class' => 'form-control mb-3'
//                ]
//            ])
            ->add('link', UrlType::class, [
                'label' => 'Lien web du media',
                'attr' => [
                    'class' => 'form-control mb-3'
                ]
            ])
            ->add('content', CKEditorType::class, [
                'label' => 'Contenu',
                'attr' => [
                    'class' => 'form-control mb-3'
                ]
            ])
//            ->add('size', TextType::class, [
//                'label' => 'Torrent size',
//                'attr' => [
//                    'class' => 'form-control mb-3'
//                ]
//            ])
            //->add('date')
            ->add('image', FileType::class, [
                'label' => 'Image du torrent',
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Image([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/webp'
                        ],
                        'mimeTypesMessage' => 'Le fichier envoyé n\'est pas valide',
                    ])
                ]
            ])
            //->add('views')
            //->add('author')
            ->add('category', EntityType::class, [
                'label' => 'Catégories du torrent (Choisissez une ou plusieurs catégories)',
                'class' => Categories::class,
                'choice_label' => 'title',
                'multiple' => true,
                'attr' => [
                    'class' => 'form-control mb-3'
                ]
                ])
            ->add('licence', EntityType::class, [
                'label' => 'Licences du torrent (Choisissez une ou plusieurs licences)',
                'class' => Licences::class,
                'choice_label' => 'title',
                'multiple' => true,
                'attr' => [
                    'class' => 'form-control mb-3'
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
