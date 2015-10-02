<?php

namespace NS\ContactBundle\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints as Assert;

class Enquiry
{
    protected $name;

    protected $email;

    protected $subject;

    protected $body;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new NotBlank());

        $metadata->addPropertyConstraint('email', new Email(array(
            'message' => 'Veuillez saisir une adresse email valide!'
        )));

        // $metadata->addPropertyConstraint('subject', new NotBlank());
        // $metadata->addPropertyConstraint('subject', new Assert\Length(array(
        //     'max'        => 50,
        //     'maxMessage' => 'Your subject cannot be longer than {{ limit }} characters long',
        // )));

        $metadata->addPropertyConstraint('body', new Assert\Length(array(
            'min'        => 2,
            'minMessage' => 'Your message must be at least {{ limit }} characters long',
        ))); 
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }
}