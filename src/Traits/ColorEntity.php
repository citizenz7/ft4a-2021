<?php

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait ColorEntity
 * @package App\Traits
 */
trait ColorEntity
{
    /**
     * @ORM\Column(type="string", length=7)
     */
    private $color;

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     * @return $this
     */
    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }
}
