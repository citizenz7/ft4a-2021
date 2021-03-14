<?php

namespace App\Entity\Legacy;

use Doctrine\ORM\Mapping as ORM;

/**
 * XbtAnnounceLog
 *
 * @ORM\Table(name="xbt_announce_log")
 * @ORM\Entity(repositoryClass="App\Repository\Legacy\XbtAnnounceLogRepository")
 */
class XbtAnnounceLog
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
     * @var int
     *
     * @ORM\Column(name="port", type="integer", nullable=false)
     */
    private $port;

    /**
     * @var int
     *
     * @ORM\Column(name="event", type="integer", nullable=false)
     */
    private $event;

    /**
     * @var binary
     *
     * @ORM\Column(name="info_hash", type="binary", nullable=false)
     */
    private $infoHash;

    /**
     * @var binary
     *
     * @ORM\Column(name="peer_id", type="binary", nullable=false)
     */
    private $peerId;

    /**
     * @var int
     *
     * @ORM\Column(name="downloaded", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $downloaded;

    /**
     * @var int
     *
     * @ORM\Column(name="left0", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $left0;

    /**
     * @var int
     *
     * @ORM\Column(name="uploaded", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $uploaded;

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

    public function getPort(): ?int
    {
        return $this->port;
    }

    public function setPort(int $port): self
    {
        $this->port = $port;

        return $this;
    }

    public function getEvent(): ?int
    {
        return $this->event;
    }

    public function setEvent(int $event): self
    {
        $this->event = $event;

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

    public function getPeerId()
    {
        return $this->peerId;
    }

    public function setPeerId($peerId): self
    {
        $this->peerId = $peerId;

        return $this;
    }

    public function getDownloaded(): ?string
    {
        return $this->downloaded;
    }

    public function setDownloaded(string $downloaded): self
    {
        $this->downloaded = $downloaded;

        return $this;
    }

    public function getLeft0(): ?string
    {
        return $this->left0;
    }

    public function setLeft0(string $left0): self
    {
        $this->left0 = $left0;

        return $this;
    }

    public function getUploaded(): ?string
    {
        return $this->uploaded;
    }

    public function setUploaded(string $uploaded): self
    {
        $this->uploaded = $uploaded;

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
