<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\String\Slugger\AsciiSlugger;

/**
 * Class Category
 * @package App\Entity
 *
 * @ORM\Table
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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
     * @ORM\ManyToMany(targetEntity=Torrent::class, mappedBy="category")
     */
    private $torrents;

    /**
     * Category constructor.
     */
    public function __construct()
    {
        $this->torrents = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     * @return $this
     */
    public function setSlug($slug): self
    {
        $this->slug = (new AsciiSlugger())->slug(strtolower($slug));

        return $this;
    }

    /**
     * @return Collection|Torrent[]
     */
    public function getTorrents(): Collection
    {
        return $this->torrents;
    }

    /**
     * @param Torrent $torrent
     * @return $this
     */
    public function addTorrent(Torrent $torrent): self
    {
        if (!$this->torrents->contains($torrent)) {
            $this->torrents[] = $torrent;
            $torrent->addCategory($this);
        }

        return $this;
    }

    /**
     * @param Torrent $torrent
     * @return $this
     */
    public function removeTorrent(Torrent $torrent): self
    {
        if ($this->torrents->removeElement($torrent)) {
            $torrent->removeCategory($this);
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function __toString(): ?string
    {
        return $this->getTitle();
    }
}
