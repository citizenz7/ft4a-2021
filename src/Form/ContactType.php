<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ContactType
 * @package App\Form
 */
class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, [
                'label_attr' => [
                    'class' => 'd-none',
                ],
                'attr' => [
                    'placeholder' => 'Veuillez entrer votre nom',
                ],
                'required' => true,
            ])
            ->add('email',EmailType::class, [
                'label_attr' => [
                    'class' => 'd-none',
                ],
                'attr' => [
                    'placeholder' => 'Veuillez entrer votre adresse e-mail',
                ],
                'required' => true,
            ])
            ->add('message', TextareaType::class, [
                'label_attr' => [
                    'class' => 'd-none',
                ],
                'attr' => [
                    'rows' => 8,
		            'placeholder' => 'Votre message',
                ],
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
