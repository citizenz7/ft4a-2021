<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 */
class Categories
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
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity=Torrents::class, mappedBy="category")
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

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
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
            $torrent->addCategory($this);
        }

        return $this;
    }

    public function removeTorrent(Torrents $torrent): self
    {
        if ($this->torrents->removeElement($torrent)) {
            $torrent->removeCategory($this);
        }

        return $this;
    }

    public function __toString(): ?string
    {
        return $this->getTitle();
    }
}
