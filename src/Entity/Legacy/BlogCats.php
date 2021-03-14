<?php

namespace App\Entity\Legacy;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlogCats
 *
 * @ORM\Table(name="blog_cats")
 * @ORM\Entity(repositoryClass="App\Repository\Legacy\BlogCatsRepository")
 */
class BlogCats
{
    /**
     * @var int
     *
     * @ORM\Column(name="catID", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $catid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="catTitle", type="string", length=255, nullable=true)
     */
    private $cattitle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="catSlug", type="string", length=255, nullable=true)
     */
    private $catslug;

    public function getCatid(): ?int
    {
        return $this->catid;
    }

    public function getCattitle(): ?string
    {
        return $this->cattitle;
    }

    public function setCattitle(?string $cattitle): self
    {
        $this->cattitle = $cattitle;

        return $this;
    }

    public function getCatslug(): ?string
    {
        return $this->catslug;
    }

    public function setCatslug(?string $catslug): self
    {
        $this->catslug = $catslug;

        return $this;
    }


}
