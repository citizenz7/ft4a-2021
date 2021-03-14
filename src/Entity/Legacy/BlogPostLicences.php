<?php

namespace App\Entity\Legacy;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlogPostLicences
 *
 * @ORM\Table(name="blog_post_licences")
 * @ORM\Entity(repositoryClass="App\Repository\Legacy\BlogPostLicencesRepository")
 */
class BlogPostLicences
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_BPL", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idBpl;

    /**
     * @var int
     *
     * @ORM\Column(name="postID_BPL", type="integer", nullable=false)
     */
    private $postidBpl;

    /**
     * @var int
     *
     * @ORM\Column(name="licenceID_BPL", type="integer", nullable=false)
     */
    private $licenceidBpl;

    public function getIdBpl(): ?int
    {
        return $this->idBpl;
    }

    public function getPostidBpl(): ?int
    {
        return $this->postidBpl;
    }

    public function setPostidBpl(int $postidBpl): self
    {
        $this->postidBpl = $postidBpl;

        return $this;
    }

    public function getLicenceidBpl(): ?int
    {
        return $this->licenceidBpl;
    }

    public function setLicenceidBpl(int $licenceidBpl): self
    {
        $this->licenceidBpl = $licenceidBpl;

        return $this;
    }


}
