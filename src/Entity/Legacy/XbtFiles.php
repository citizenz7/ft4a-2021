<?php

namespace App\Entity\Legacy;

use Doctrine\ORM\Mapping as ORM;

/**
 * XbtFiles
 *
 * @ORM\Table(name="xbt_files", uniqueConstraints={@ORM\UniqueConstraint(name="info_hash", columns={"info_hash"})})
 * @ORM\Entity(repositoryClass="App\Repository\Legacy\XbtFilesRepository")
 */
class XbtFiles
{
    /**
     * @var int
     *
     * @ORM\Column(name="fid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $fid;

    /**
     * @var binary
     *
     * @ORM\Column(name="info_hash", type="binary", nullable=false)
     */
    private $infoHash;

    /**
     * @var int
     *
     * @ORM\Column(name="leechers", type="integer", nullable=false)
     */
    private $leechers = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="seeders", type="integer", nullable=false)
     */
    private $seeders = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="completed", type="integer", nullable=false)
     */
    private $completed = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="flags", type="integer", nullable=false)
     */
    private $flags = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="mtime", type="integer", nullable=false)
     */
    private $mtime;

    /**
     * @var int
     *
     * @ORM\Column(name="ctime", type="integer", nullable=false)
     */
    private $ctime;

    public function getFid(): ?int
    {
        return $this->fid;
    }

    public function getInfoHash()
    {
        return $this->infoHash;
    }

    public function setInfoHash($infoHash): self
    {
        $this->infoHash = $infoHash;

        return $this;
    }

    public function getLeechers(): ?int
    {
        return $this->leechers;
    }

    public function setLeechers(int $leechers): self
    {
        $this->leechers = $leechers;

        return $this;
    }

    public function getSeeders(): ?int
    {
        return $this->seeders;
    }

    public function setSeeders(int $seeders): self
    {
        $this->seeders = $seeders;

        return $this;
    }

    public function getCompleted(): ?int
    {
        return $this->completed;
    }

    public function setCompleted(int $completed): self
    {
        $this->completed = $completed;

        return $this;
    }

    public function getFlags(): ?int
    {
        return $this->flags;
    }

    public function setFlags(int $flags): self
    {
        $this->flags = $flags;

        return $this;
    }

    public function getMtime(): ?int
    {
        return $this->mtime;
    }

    public function setMtime(int $mtime): self
    {
        $this->mtime = $mtime;

        return $this;
    }

    public function getCtime(): ?int
    {
        return $this->ctime;
    }

    public function setCtime(int $ctime): self
    {
        $this->ctime = $ctime;

        return $this;
    }


}
