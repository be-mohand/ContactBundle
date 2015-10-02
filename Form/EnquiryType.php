<?php

namespace NS\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EnquiryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array('label'=>'Nom'));
        $builder->add('email', 'email', array('label'=>'E-mail'));
        $builder->add('body', 'textarea', array('label'=>'Votre message'));
    }

    public function getName()
    {
        return 'contact';
    }
}