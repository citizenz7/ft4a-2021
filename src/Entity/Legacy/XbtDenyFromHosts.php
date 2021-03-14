<?php

namespace App\Entity\Legacy;

use Doctrine\ORM\Mapping as ORM;

/**
 * XbtDenyFromHosts
 *
 * @ORM\Table(name="xbt_deny_from_hosts")
 * @ORM\Entity(repositoryClass="App\Repository\Legacy\XbtDenyFromHostsRepository")
 */
class XbtDenyFromHosts
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
     * @ORM\Column(name="begin", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $begin;

    /**
     * @var int
     *
     * @ORM\Column(name="end", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $end;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBegin(): ?int
    {
        return $this->begin;
    }

    public function setBegin(int $begin): self
    {
        $this->begin = $begin;

        return $this;
    }

    public function getEnd(): ?int
    {
        return $this->end;
    }

    public function setEnd(int $end): self
    {
        $this->end = $end;

        return $this;
    }


}
