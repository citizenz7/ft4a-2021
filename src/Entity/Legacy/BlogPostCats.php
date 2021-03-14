<?php

namespace App\Entity\Legacy;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlogPostCats
 *
 * @ORM\Table(name="blog_post_cats")
 * @ORM\Entity(repositoryClass="App\Repository\Legacy\BlogPostCatsRepository")
 */
class BlogPostCats
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="postID", type="integer", nullable=true)
     */
    private $postid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="catID", type="integer", nullable=true)
     */
    private $catid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostid(): ?int
    {
        return $this->postid;
    }

    public function setPostid(?int $postid): self
    {
        $this->postid = $postid;

        return $this;
    }

    public function getCatid(): ?int
    {
        return $this->catid;
    }

    public function setCatid(?int $catid): self
    {
        $this->catid = $catid;

        return $this;
    }


}
