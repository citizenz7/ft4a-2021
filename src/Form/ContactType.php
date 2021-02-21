<?php

namespace App\Form;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Veuillez entrer votre nom'
                ]
            ])
            ->add('email',EmailType::class, [
                'label' => 'E-mail',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Veuillez entrer votre adresse e-mail'
                ]
            ])
            ->add('message', CKEditorType::class, [
                'label' => 'Veuillez composer votre message',
                'attr' => [
                    'rows' => 8,
                    'class' => 'form-control mb-3'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
