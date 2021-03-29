<?php

namespace App\Service;

use App\Service\Mjml\RendererMjmlService;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

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
     * @var Environment
     */
    private $twig;
    /**
     * @var string
     */
    private $binMjml;

    /**
     * MailerServiceService constructor.
     * @param MailerInterface $mailer
     * @param LoggerInterface $logger
     * @param Environment $twig
     * @param string $binMjml
     */
    public function __construct(MailerInterface $mailer, LoggerInterface $logger, Environment $twig, string $binMjml)
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
        $this->twig = $twig;
        $this->binMjml = $binMjml;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function send(array $from, string $to, string $subject, string $mjmlTemplate, string $textTemplate, array $params): void
    {
        $email = (new TemplatedEmail())
            ->from(new Address($from[0], $from[1]))
            ->to(new Address($to))
            ->subject($subject)
            ->html($this->convertMjmlToHtml($mjmlTemplate, $params))
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

    /**
     * @param string $templateMjml
     * @param array $context
     * @return string
     * @throws Exception
     */
    private function convertMjmlToHtml(string $templateMjml, array $context): string
    {
        try {
            return (new RendererMjmlService($this->binMjml))
                ->render($this->twig->render($templateMjml, $context));
        } catch (LoaderError | RuntimeError | SyntaxError $exception) {
            throw new Exception($exception);
        }
    }
}
