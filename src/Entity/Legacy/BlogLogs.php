<?php

namespace App\Entity\Legacy;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlogLogs
 *
 * @ORM\Table(name="blog_logs")
 * @ORM\Entity(repositoryClass="App\Repository\Legacy\BlogLogsRepository")
 */
class BlogLogs
{
    /**
     * @var int
     *
     * @ORM\Column(name="log_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $logId;

    /**
     * @var string
     *
     * @ORM\Column(name="remote_addr", type="string", length=255, nullable=false)
     */
    private $remoteAddr;

    /**
     * @var string
     *
     * @ORM\Column(name="request_uri", type="string", length=255, nullable=false)
     */
    private $requestUri;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", length=65535, nullable=false)
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="log_date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $logDate = 'CURRENT_TIMESTAMP';

    public function getLogId(): ?int
    {
        return $this->logId;
    }

    public function getRemoteAddr(): ?string
    {
        return $this->remoteAddr;
    }

    public function setRemoteAddr(string $remoteAddr): self
    {
        $this->remoteAddr = $remoteAddr;

        return $this;
    }

    public function getRequestUri(): ?string
    {
        return $this->requestUri;
    }

    public function setRequestUri(string $requestUri): self
    {
        $this->requestUri = $requestUri;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getLogDate(): ?\DateTimeInterface
    {
        return $this->logDate;
    }

    public function setLogDate(\DateTimeInterface $logDate): self
    {
        $this->logDate = $logDate;

        return $this;
    }


}
