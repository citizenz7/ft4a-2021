<?php

namespace App\Entity;

use App\Repository\TorrentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Blameable\Traits\BlameableEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\String\Slugger\AsciiSlugger;

/**
 * Class Torrent
 * @package App\Entity
 *
 * @ORM\Table
 * @ORM\Entity(repositoryClass=TorrentRepository::class)
 */
class Torrent
{
    use BlameableEntity;
    use TimestampableEntity;

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
     * @ORM\Column(type="string", length=40)
     */
    private $hash;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="bigint")
     */
    private $size;

    /**
     * @ORM\Column(name="torrent_file", type="string", length=255)
     */
    private $torrentFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $views;

    /**
     * @ORM\ManyToOne(targetEntity=Member::class, inversedBy="torrents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="torrents")
     * @ORM\JoinColumn(nullable=true)
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=Licence::class, inversedBy="torrents")
     * @ORM\JoinColumn(nullable=true)
     */
    private $licence;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="torrent")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=TorrentFile::class, mappedBy="torrent", orphanRemoval=true)
     */
    private $file;

    /**
     * Torrent constructor.
     */
    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->licence = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->file = new ArrayCollection();
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
     * @return string|null
     */
    public function getHash(): ?string
    {
        return $this->hash;
    }

    /**
     * @param string|null $hash
     * @return $this
     */
    public function setHash(?string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param string|null $link
     * @return $this
     */
    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @param int|null $size
     * @return $this
     */
    public function setSize(?int $size): self
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTorrentFile(): ?string
    {
        return $this->torrentFile;
    }

    /**
     * @param string $torrentFile
     * @return $this
     */
    public function setTorrentFile(string $torrentFile): self
    {
        $this->torrentFile = $torrentFile;

        return $this;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param $image
     * @return $this
     */
    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getViews(): ?int
    {
        return $this->views;
    }

    /**
     * @param int $views
     * @return $this
     */
    public function setViews(int $views): self
    {
        $this->views = $views;

        return $this;
    }

    /**
     * @return Member|null
     */
    public function getAuthor(): ?Member
    {
        return $this->author;
    }

    /**
     * @param Member|null $author
     * @return $this
     */
    public function setAuthor(?Member $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|Category[]|null
     */
    public function getCategory(): ?Collection
    {
        return $this->category;
    }

    /**
     * @param Category $category
     * @return $this
     */
    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    /**
     * @param Category $category
     * @return $this
     */
    public function removeCategory(Category $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }

    /**
     * @return Collection|Licence[]|null
     */
    public function getLicence(): ?Collection
    {
        return $this->licence;
    }

    /**
     * @param Licence $licence
     * @return $this
     */
    public function addLicence(Licence $licence): self
    {
        if (!$this->licence->contains($licence)) {
            $this->licence[] = $licence;
        }

        return $this;
    }

    /**
     * @param Licence $licence
     * @return $this
     */
    public function removeLicence(Licence $licence): self
    {
        $this->licence->removeElement($licence);

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    /**
     * @param Comment $comment
     * @return $this
     */
    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setTorrent($this);
        }

        return $this;
    }

    /**
     * @param Comment $comment
     * @return $this
     */
    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getTorrent() === $this) {
                $comment->setTorrent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TorrentFile[]
     */
    public function getFile(): Collection
    {
        return $this->file;
    }

    public function addFile(TorrentFile $file): self
    {
        if (!$this->file->contains($file)) {
            $this->file[] = $file;
            $file->setTorrent($this);
        }

        return $this;
    }

    public function removeFile(TorrentFile $file): self
    {
        if ($this->file->removeElement($file)) {
            // set the owning side to null (unless already changed)
            if ($file->getTorrent() === $this) {
                $file->setTorrent(null);
            }
        }

        return $this;
    }
}
