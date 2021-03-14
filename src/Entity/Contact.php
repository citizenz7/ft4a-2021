<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Contact
 * @package App\Entity
 */
class Contact
{
    /**
     * @var string
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "Votre nom doit comporter au moins {{ limite }} caractères.",
     * )
     */
    private $name;
    /**
     * @var string
     * @Assert\Email(message = "L'email '{{ value }}' est non valide.")
     */
    private $email;
    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $message;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
