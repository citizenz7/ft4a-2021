<?php

namespace App\Entity;

use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ChangePassword
 * @package App\Entity
 */
class ChangePassword
{
    /**
     * @SecurityAssert\UserPassword(
     *     message = "profile.type.password.current_password"
     * )
     */
    protected $oldPassword;

    /**
     * @Assert\Length(
     *     min = 8,
     *     max = 50,
     *     minMessage = "profile.type.password.length_min",
     *     maxMessage = "profile.type.password.length_max"
     * )
     */
    protected $newPassword;

    /**
     * @return string
     */
    public function getOldPassword(): string
    {
        return $this->oldPassword;
    }

    /**
     * @param string $oldPassword
     * @return $this
     */
    public function setOldPassword(string $oldPassword): self
    {
        $this->oldPassword = $oldPassword;

        return $this;
    }

    /**
     * @return string
     */
    public function getNewPassword(): string
    {
        return $this->newPassword;
    }

    /**
     * @param string $newPassword
     * @return $this
     */
    public function setNewPassword(string $newPassword): self
    {
        $this->newPassword = $newPassword;

        return $this;
    }
}
