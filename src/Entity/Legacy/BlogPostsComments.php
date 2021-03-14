<?php

namespace App\Entity\Legacy;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlogPostsComments
 *
 * @ORM\Table(name="blog_posts_comments")
 * @ORM\Entity(repositoryClass="App\Repository\Legacy\BlogPostsCommentsRepository")
 */
class BlogPostsComments
{
    /**
     * @var int
     *
     * @ORM\Column(name="cid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cid;

    /**
     * @var int
     *
     * @ORM\Column(name="cid_torrent", type="integer", nullable=false)
     */
    private $cidTorrent;

    /**
     * @var int
     *
     * @ORM\Column(name="cid_parent", type="integer", nullable=false)
     */
    private $cidParent = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cadded", type="datetime", nullable=false)
     */
    private $cadded;

    /**
     * @var string
     *
     * @ORM\Column(name="ctext", type="text", length=65535, nullable=false)
     */
    private $ctext;

    /**
     * @var string
     *
     * @ORM\Column(name="cuser", type="string", length=25, nullable=false)
     */
    private $cuser;

    public function getCid(): ?int
    {
        return $this->cid;
    }

    public function getCidTorrent(): ?int
    {
        return $this->cidTorrent;
    }

    public function setCidTorrent(int $cidTorrent): self
    {
        $this->cidTorrent = $cidTorrent;

        return $this;
    }

    public function getCidParent(): ?int
    {
        return $this->cidParent;
    }

    public function setCidParent(int $cidParent): self
    {
        $this->cidParent = $cidParent;

        return $this;
    }

    public function getCadded(): ?\DateTimeInterface
    {
        return $this->cadded;
    }

    public function setCadded(\DateTimeInterface $cadded): self
    {
        $this->cadded = $cadded;

        return $this;
    }

    public function getCtext(): ?string
    {
        return $this->ctext;
    }

    public function setCtext(string $ctext): self
    {
        $this->ctext = $ctext;

        return $this;
    }

    public function getCuser(): ?string
    {
        return $this->cuser;
    }

    public function setCuser(string $cuser): self
    {
        $this->cuser = $cuser;

        return $this;
    }


}
