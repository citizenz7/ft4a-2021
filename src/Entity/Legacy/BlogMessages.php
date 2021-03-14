<?php

namespace App\Entity\Legacy;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlogMessages
 *
 * @ORM\Table(name="blog_messages")
 * @ORM\Entity(repositoryClass="App\Repository\Legacy\BlogMessagesRepository")
 */
class BlogMessages
{
    /**
     * @var int
     *
     * @ORM\Column(name="messages_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $messagesId;

    /**
     * @var int
     *
     * @ORM\Column(name="messages_id_expediteur", type="integer", nullable=false)
     */
    private $messagesIdExpediteur = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="messages_id_destinataire", type="integer", nullable=false)
     */
    private $messagesIdDestinataire = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="messages_date", type="datetime", nullable=false, options={"default"="0000-00-00 00:00:00"})
     */
    private $messagesDate = '0000-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="messages_titre", type="text", length=65535, nullable=false)
     */
    private $messagesTitre;

    /**
     * @var string
     *
     * @ORM\Column(name="messages_message", type="text", length=65535, nullable=false)
     */
    private $messagesMessage;

    /**
     * @var string
     *
     * @ORM\Column(name="messages_lu", type="string", length=0, nullable=false)
     */
    private $messagesLu = '0';

    public function getMessagesId(): ?int
    {
        return $this->messagesId;
    }

    public function getMessagesIdExpediteur(): ?int
    {
        return $this->messagesIdExpediteur;
    }

    public function setMessagesIdExpediteur(int $messagesIdExpediteur): self
    {
        $this->messagesIdExpediteur = $messagesIdExpediteur;

        return $this;
    }

    public function getMessagesIdDestinataire(): ?int
    {
        return $this->messagesIdDestinataire;
    }

    public function setMessagesIdDestinataire(int $messagesIdDestinataire): self
    {
        $this->messagesIdDestinataire = $messagesIdDestinataire;

        return $this;
    }

    public function getMessagesDate(): ?\DateTimeInterface
    {
        return $this->messagesDate;
    }

    public function setMessagesDate(\DateTimeInterface $messagesDate): self
    {
        $this->messagesDate = $messagesDate;

        return $this;
    }

    public function getMessagesTitre(): ?string
    {
        return $this->messagesTitre;
    }

    public function setMessagesTitre(string $messagesTitre): self
    {
        $this->messagesTitre = $messagesTitre;

        return $this;
    }

    public function getMessagesMessage(): ?string
    {
        return $this->messagesMessage;
    }

    public function setMessagesMessage(string $messagesMessage): self
    {
        $this->messagesMessage = $messagesMessage;

        return $this;
    }

    public function getMessagesLu(): ?string
    {
        return $this->messagesLu;
    }

    public function setMessagesLu(string $messagesLu): self
    {
        $this->messagesLu = $messagesLu;

        return $this;
    }


}
