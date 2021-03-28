<?php

namespace App\EventListener;

use App\Entity\Member;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

/**
 * Class LoginListener
 * @package App\EventListener
 */
class LoginListener
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * LoginListener constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param InteractiveLoginEvent $event
     */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event): void
    {
        /** @var Member $user */
        $user = $event->getAuthenticationToken()->getUser();
        $user->setLastLogin(new \DateTime());

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
