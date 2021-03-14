<?php

namespace App\Entity\Legacy;

use Doctrine\ORM\Mapping as ORM;

/**
 * XbtUsers
 *
 * @ORM\Table(name="xbt_users")
 * @ORM\Entity(repositoryClass="App\Repository\Legacy\XbtUsersRepository")
 */
class XbtUsers
{
    /**
     * @var int
     *
     * @ORM\Column(name="uid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $uid;

    /**
     * @var int
     *
     * @ORM\Column(name="torrent_pass_version", type="integer", nullable=false)
     */
    private $torrentPassVersion = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="downloaded", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $downloaded = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="uploaded", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $uploaded = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="torrent_pass", type="string", length=32, nullable=false, options={"fixed"=true})
     */
    private $torrentPass;

    /**
     * @var int
     *
     * @ORM\Column(name="torrent_pass_secret", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $torrentPassSecret;

    public function getUid(): ?int
    {
        return $this->uid;
    }

    public function getTorrentPassVersion(): ?int
    {
        return $this->torrentPassVersion;
    }

    public function setTorrentPassVersion(int $torrentPassVersion): self
    {
        $this->torrentPassVersion = $torrentPassVersion;

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

    public function getUploaded(): ?string
    {
        return $this->uploaded;
    }

    public function setUploaded(string $uploaded): self
    {
        $this->uploaded = $uploaded;

        return $this;
    }

    public function getTorrentPass(): ?string
    {
        return $this->torrentPass;
    }

    public function setTorrentPass(string $torrentPass): self
    {
        $this->torrentPass = $torrentPass;

        return $this;
    }

    public function getTorrentPassSecret(): ?string
    {
        return $this->torrentPassSecret;
    }

    public function setTorrentPassSecret(string $torrentPassSecret): self
    {
        $this->torrentPassSecret = $torrentPassSecret;

        return $this;
    }


}
