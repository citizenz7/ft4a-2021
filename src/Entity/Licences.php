<?php

namespace App\Entity;

use App\Repository\LicencesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=LicencesRepository::class)
 */
class Licences
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
    private $title;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity=Torrents::class, mappedBy="licence")
     */
    private $torrents;

    public function __construct()
    {
        $this->torrents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @return Collection|Torrents[]
     */
    public function getTorrents(): Collection
    {
        return $this->torrents;
    }

    public function addTorrent(Torrents $torrent): self
    {
        if (!$this->torrents->contains($torrent)) {
            $this->torrents[] = $torrent;
            $torrent->addLicence($this);
        }

        return $this;
    }

    public function removeTorrent(Torrents $torrent): self
    {
        if ($this->torrents->removeElement($torrent)) {
            $torrent->removeLicence($this);
        }

        return $this;
    }

    public function __toString(): ?string
    {
        return $this->getTitle();
    }
}
