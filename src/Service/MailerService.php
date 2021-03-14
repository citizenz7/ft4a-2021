<?php

namespace App\Service;

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
     * @var string
     */
    private $from;
    /**
     * @var string
     */
    private $subject;

    /**
     * MailerServiceService constructor.
     * @param MailerInterface $mailer
     * @param LoggerInterface $logger
     * @param string $from
     * @param string $subject
     */
    public function __construct(MailerInterface $mailer, LoggerInterface $logger, string $from, string $subject)
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
        $this->from = $from;
        $this->subject = $subject;
    }

    /**
     * @param string $to
     * @param string $htmlTemplate
     * @param string $textTemplate
     * @param array $params
     */
    public function send(string $to, string $htmlTemplate, string $textTemplate, array $params): void
    {
        $email = (new TemplatedEmail())
            ->from($this->from)
            ->to(new Address($to))
            ->subject($this->subject)
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
