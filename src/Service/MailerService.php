<?php

namespace App\Service;

use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

/**
 * Class MailerServiceService
 * @package App\Service
 */
class MailerService implements MailerServiceInterface
{
    /**
     * @var MailerInterface
     */
    private $mailer;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * MailerServiceService constructor.
     * @param MailerInterface $mailer
     * @param LoggerInterface $logger
     */
    public function __construct(MailerInterface $mailer, LoggerInterface $logger)
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function send(array $from, string $to, string $subject, string $htmlTemplate, string $textTemplate, array $params): void
    {
        $email = (new TemplatedEmail())
            ->from(new Address($from[0], $from[1]))
            ->to(new Address($to))
            ->subject($subject)
            ->htmlTemplate($htmlTemplate)
            ->textTemplate($textTemplate)
            ->context($params)
        ;

        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $exception) {
            $this->logger->error("Un problème est survenue lors de l'envoye de mail", [
                'exception' => $exception,
            ]);
        }
    }
}
