<?php

namespace App\Entity\Legacy;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlogInfos
 *
 * @ORM\Table(name="blog_infos")
 * @ORM\Entity
 */
class BlogInfos
{
    /**
     * @var int
     *
     * @ORM\Column(name="infoID", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $infoid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="infoTitle", type="string", length=255, nullable=true)
     */
    private $infotitle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="infoSlug", type="string", length=255, nullable=true)
     */
    private $infoslug;

    /**
     * @var string|null
     *
     * @ORM\Column(name="infoCont", type="text", length=65535, nullable=true)
     */
    private $infocont;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="infoDate", type="datetime", nullable=true)
     */
    private $infodate;

    public function getInfoid(): ?int
    {
        return $this->infoid;
    }

    public function getInfotitle(): ?string
    {
        return $this->infotitle;
    }

    public function setInfotitle(?string $infotitle): self
    {
        $this->infotitle = $infotitle;

        return $this;
    }

    public function getInfoslug(): ?string
    {
        return $this->infoslug;
    }

    public function setInfoslug(?string $infoslug): self
    {
        $this->infoslug = $infoslug;

        return $this;
    }

    public function getInfocont(): ?string
    {
        return $this->infocont;
    }

    public function setInfocont(?string $infocont): self
    {
        $this->infocont = $infocont;

        return $this;
    }

    public function getInfodate(): ?\DateTimeInterface
    {
        return $this->infodate;
    }

    public function setInfodate(?\DateTimeInterface $infodate): self
    {
        $this->infodate = $infodate;

        return $this;
    }


}
