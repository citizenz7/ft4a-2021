<?php

namespace App\Entity\Legacy;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlogLicences
 *
 * @ORM\Table(name="blog_licences")
 * @ORM\Entity
 */
class BlogLicences
{
    /**
     * @var int
     *
     * @ORM\Column(name="licenceID", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $licenceid;

    /**
     * @var string
     *
     * @ORM\Column(name="licenceTitle", type="string", length=255, nullable=false)
     */
    private $licencetitle;

    /**
     * @var string
     *
     * @ORM\Column(name="licenceSlug", type="string", length=255, nullable=false)
     */
    private $licenceslug;

    public function getLicenceid(): ?int
    {
        return $this->licenceid;
    }

    public function getLicencetitle(): ?string
    {
        return $this->licencetitle;
    }

    public function setLicencetitle(string $licencetitle): self
    {
        $this->licencetitle = $licencetitle;

        return $this;
    }

    public function getLicenceslug(): ?string
    {
        return $this->licenceslug;
    }

    public function setLicenceslug(string $licenceslug): self
    {
        $this->licenceslug = $licenceslug;

        return $this;
    }


}
