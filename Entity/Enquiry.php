<?php

namespace NS\ContactBundle\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints as Assert;

class Enquiry
{
    /**
     * @Assert\NotBlank(message="Le nom ne peut pas être vide", groups = {"new"})
     * @var
     */
    protected $name;

    /**
     * @var
     * @Assert\Email(message="L'email n'est pas conforme", groups={"new"})
     */
    protected $email;

    /**
     * @var
     */
    protected $subject;

    /**
     * @var
     * @Assert\NotBlank(message="Le contenu ne doit pas être vide", groups = {"new"})
     * @Assert\Length(
     *     min="3",
     *     max="50",
     *     minMessage="Le contenu doit avoir au minimum {{ limit }} caractères",
     *     maxMessage="Le contenu peut avoir au maximum {{ limit }} caractères",
     *     groups={"new"}
     * )
     */
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