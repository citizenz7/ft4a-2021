<?php

namespace App\Form;

use App\Entity\Comments;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author', TextType::class, [
                'label' => 'Your name',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('content', CKEditorType::class, [
                'label' => 'Your comment',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
           //->add('date')
            //->add('active')
            //->add('torrent')
            ->add('parentid', HiddenType::class, [
                'mapped' => false
           ])
            ->add('send', SubmitType::class, [
                'label' => 'Send',
                'attr' => [
                    'class' => 'btn btn-sm btn-success'
                ]
            ])
            ->add('reset', ResetType::class, [
                'label' => 'Reset',
                'attr' => [
                    'class' => 'btn btn-sm btn-secondary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comments::class,
        ]);
    }
}
