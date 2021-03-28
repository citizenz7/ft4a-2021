<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Member
 * @package App\Entity
 *
 * @ORM\Table
 * @ORM\Entity(repositoryClass=MemberRepository::class)
 * @UniqueEntity(fields={"username"}, message="Ce pseudo est déjà utilisé")
 * @UniqueEntity(fields={"email"}, message="Cette adresse email est déjà utilisée")
 */
class Member implements UserInterface
{
    public const MEMBER_ROLE_ADMIN = 'ROLE_ADMIN';
    public const MEMBER_ROLE_USER = 'ROLE_USER';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string",  length=50, unique=true)
     */
    private $pid;

    /**
     * @ORM\Column(type="datetime")
     */
    private $registration;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastLogin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $signature;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(name="is_verified", type="boolean")
     */
    private $isVerified;

    /**
     * @ORM\OneToMany(targetEntity=Torrent::class, mappedBy="author")
     */
    private $torrents;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="author", orphanRemoval=true)
     */
    private $comments;

    /**
     * Member constructor.
     */
    public function __construct()
    {
        $this->isActive = false;
        $this->isVerified = false;
        $this->registration = new DateTime();
        $this->lastLogin = new DateTime();
        $this->pid = md5(uniqid(rand(),true));
        $this->torrents = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param array $roles
     * @return $this
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
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
     * @return string|null
     */
    public function getPid(): ?string
    {
        return $this->pid;
    }

    /**
     * @param string $pid
     * @return $this
     */
    public function setPid(string $pid): self
    {
        $this->pid = $pid;

        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getRegistration(): DateTimeInterface
    {
        return $this->registration;
    }

    /**
     * @param DateTimeInterface $registration
     * @return $this
     */
    public function setRegistration(DateTimeInterface $registration): self
    {
        $this->registration = $registration;

        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getLastLogin(): DateTimeInterface
    {
        return $this->lastLogin;
    }

    /**
     * @param DateTimeInterface $lastLogin
     * @return $this
     */
    public function setLastLogin(DateTimeInterface $lastLogin): self
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     * @return $this
     */
    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSignature(): ?string
    {
        return $this->signature;
    }

    /**
     * @param string|null $signature
     * @return $this
     */
    public function setSignature(?string $signature): self
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     * @return $this
     */
    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return bool
     */
    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    /**
     * @param bool $isVerified
     * @return $this
     */
    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

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
            $torrent->setAuthor($this);
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
            // set the owning side to null (unless already changed)
            if ($torrent->getAuthor() === $this) {
                $torrent->setAuthor(null);
            }
        }

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
            $comment->setAuthor($this);
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
            if ($comment->getAuthor() === $this) {
                $comment->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getUsername();
    }
}
