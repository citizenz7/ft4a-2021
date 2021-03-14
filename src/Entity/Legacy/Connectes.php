<?php

namespace App\Entity\Legacy;

use Doctrine\ORM\Mapping as ORM;

/**
 * Connectes
 *
 * @ORM\Table(name="connectes")
 * @ORM\Entity(repositoryClass="App\Repository\Legacy\ConnectesRepository")
 */
class Connectes
{
    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=45, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="pseudo", type="string", length=255, nullable=false)
     */
    private $pseudo;

    /**
     * @var int
     *
     * @ORM\Column(name="timestamp", type="integer", nullable=false)
     */
    private $timestamp;

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getTimestamp(): ?int
    {
        return $this->timestamp;
    }

    public function setTimestamp(int $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }


}
