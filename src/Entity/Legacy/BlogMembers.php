<?php

namespace App\Entity\Legacy;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlogMembers
 *
 * @ORM\Table(name="blog_members")
 * @ORM\Entity(repositoryClass="App\Repository\Legacy\BlogMembersRepository")
 */
class BlogMembers
{
    /**
     * @var int
     *
     * @ORM\Column(name="memberID", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $memberid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=true)
     */
    private $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="pid", type="string", length=32, nullable=false)
     */
    private $pid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="memberDate", type="datetime", nullable=false)
     */
    private $memberdate;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="string", length=255, nullable=false)
     */
    private $avatar;

    /**
     * @var string
     *
     * @ORM\Column(name="active", type="string", length=255, nullable=false)
     */
    private $active;

    public function getMemberid(): ?int
    {
        return $this->memberid;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPid(): ?string
    {
        return $this->pid;
    }

    public function setPid(string $pid): self
    {
        $this->pid = $pid;

        return $this;
    }

    public function getMemberdate(): ?\DateTimeInterface
    {
        return $this->memberdate;
    }

    public function setMemberdate(\DateTimeInterface $memberdate): self
    {
        $this->memberdate = $memberdate;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getActive(): ?string
    {
        return $this->active;
    }

    public function setActive(string $active): self
    {
        $this->active = $active;

        return $this;
    }


}
