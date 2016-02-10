<?php

namespace NS\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnquiryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array('label'=>'Nom'));
        $builder->add('email', 'email', array('label'=>'E-mail'));
        $builder->add('body', 'textarea', array('label'=>'Votre message'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'translation_domain' => 'NSContactBundle',
                'validation_groups'  => ['new']
            ]
        );
    }

    public function getName()
    {
        return 'contact';
    }
}