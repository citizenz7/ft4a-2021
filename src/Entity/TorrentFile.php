<?php

namespace App\Entity;

use App\Repository\TorrentFileRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TorrentFileRepository::class)
 */
class TorrentFile
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity=Torrent::class, inversedBy="file")
     * @ORM\JoinColumn(nullable=false)
     */
    private $torrent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getTorrent(): ?Torrent
    {
        return $this->torrent;
    }

    public function setTorrent(?Torrent $torrent): self
    {
        $this->torrent = $torrent;

        return $this;
    }
}
