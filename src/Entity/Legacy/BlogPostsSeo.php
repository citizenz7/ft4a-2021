<?php

namespace App\Entity\Legacy;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlogPostsSeo
 *
 * @ORM\Table(name="blog_posts_seo")
 * @ORM\Entity(repositoryClass="App\Repository\Legacy\BlogPostsSeoRepository")
 */
class BlogPostsSeo
{
    /**
     * @var int
     *
     * @ORM\Column(name="postID", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $postid;

    /**
     * @var string
     *
     * @ORM\Column(name="postHash", type="string", length=40, nullable=false)
     */
    private $posthash;

    /**
     * @var string|null
     *
     * @ORM\Column(name="postTitle", type="string", length=255, nullable=true)
     */
    private $posttitle;

    /**
     * @var string
     *
     * @ORM\Column(name="postAuthor", type="string", length=255, nullable=false)
     */
    private $postauthor;

    /**
     * @var string|null
     *
     * @ORM\Column(name="postSlug", type="string", length=255, nullable=true)
     */
    private $postslug;

    /**
     * @var string
     *
     * @ORM\Column(name="postLink", type="string", length=255, nullable=false)
     */
    private $postlink;

    /**
     * @var string|null
     *
     * @ORM\Column(name="postDesc", type="text", length=65535, nullable=true)
     */
    private $postdesc;

    /**
     * @var string|null
     *
     * @ORM\Column(name="postCont", type="text", length=65535, nullable=true)
     */
    private $postcont;

    /**
     * @var int
     *
     * @ORM\Column(name="postTaille", type="bigint", nullable=false)
     */
    private $posttaille = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="postDate", type="datetime", nullable=true)
     */
    private $postdate;

    /**
     * @var string
     *
     * @ORM\Column(name="postTorrent", type="string", length=150, nullable=false)
     */
    private $posttorrent;

    /**
     * @var string
     *
     * @ORM\Column(name="postImage", type="string", length=255, nullable=false)
     */
    private $postimage;

    /**
     * @var int
     *
     * @ORM\Column(name="postViews", type="integer", nullable=false)
     */
    private $postviews;

    public function getPostid(): ?int
    {
        return $this->postid;
    }

    public function getPosthash(): ?string
    {
        return $this->posthash;
    }

    public function setPosthash(string $posthash): self
    {
        $this->posthash = $posthash;

        return $this;
    }

    public function getPosttitle(): ?string
    {
        return $this->posttitle;
    }

    public function setPosttitle(?string $posttitle): self
    {
        $this->posttitle = $posttitle;

        return $this;
    }

    public function getPostauthor(): ?string
    {
        return $this->postauthor;
    }

    public function setPostauthor(string $postauthor): self
    {
        $this->postauthor = $postauthor;

        return $this;
    }

    public function getPostslug(): ?string
    {
        return $this->postslug;
    }

    public function setPostslug(?string $postslug): self
    {
        $this->postslug = $postslug;

        return $this;
    }

    public function getPostlink(): ?string
    {
        return $this->postlink;
    }

    public function setPostlink(string $postlink): self
    {
        $this->postlink = $postlink;

        return $this;
    }

    public function getPostdesc(): ?string
    {
        return $this->postdesc;
    }

    public function setPostdesc(?string $postdesc): self
    {
        $this->postdesc = $postdesc;

        return $this;
    }

    public function getPostcont(): ?string
    {
        return $this->postcont;
    }

    public function setPostcont(?string $postcont): self
    {
        $this->postcont = $postcont;

        return $this;
    }

    public function getPosttaille(): ?string
    {
        return $this->posttaille;
    }

    public function setPosttaille(string $posttaille): self
    {
        $this->posttaille = $posttaille;

        return $this;
    }

    public function getPostdate(): ?\DateTimeInterface
    {
        return $this->postdate;
    }

    public function setPostdate(?\DateTimeInterface $postdate): self
    {
        $this->postdate = $postdate;

        return $this;
    }

    public function getPosttorrent(): ?string
    {
        return $this->posttorrent;
    }

    public function setPosttorrent(string $posttorrent): self
    {
        $this->posttorrent = $posttorrent;

        return $this;
    }

    public function getPostimage(): ?string
    {
        return $this->postimage;
    }

    public function setPostimage(string $postimage): self
    {
        $this->postimage = $postimage;

        return $this;
    }

    public function getPostviews(): ?int
    {
        return $this->postviews;
    }

    public function setPostviews(int $postviews): self
    {
        $this->postviews = $postviews;

        return $this;
    }


}
