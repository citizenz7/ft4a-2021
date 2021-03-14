<?php

namespace App\Entity\Legacy;

use Doctrine\ORM\Mapping as ORM;

/**
 * XbtScrapeLog
 *
 * @ORM\Table(name="xbt_scrape_log")
 * @ORM\Entity(repositoryClass="App\Repository\Legacy\XbtScrapeLogRepository")
 */
class XbtScrapeLog
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="ipa", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $ipa;

    /**
     * @var binary|null
     *
     * @ORM\Column(name="info_hash", type="binary", nullable=true)
     */
    private $infoHash;

    /**
     * @var int
     *
     * @ORM\Column(name="uid", type="integer", nullable=false)
     */
    private $uid;

    /**
     * @var int
     *
     * @ORM\Column(name="mtime", type="integer", nullable=false)
     */
    private $mtime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIpa(): ?int
    {
        return $this->ipa;
    }

    public function setIpa(int $ipa): self
    {
        $this->ipa = $ipa;

        return $this;
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

    public function getUid(): ?int
    {
        return $this->uid;
    }

    public function setUid(int $uid): self
    {
        $this->uid = $uid;

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


}
