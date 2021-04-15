<?php

namespace App\Command\Email;

use App\Service\MailerServiceInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class LegacyImportCategoryCommand
 * @package App\Command
 */
class EmailCommand extends Command
{
    protected static $defaultName = 'email:mjml-check';
    protected static $defaultDescription = 'Check of email.';
    /**
     * @var MailerServiceInterface
     */
    private $mailerService;
    /**
     * @var string
     */
    private $demoAddressEmail;

    /**
     * EmailCommand constructor.
     * @param string|null $name
     * @param MailerServiceInterface $mailerService
     */
    public function __construct(string $name = null, MailerServiceInterface $mailerService)
    {
        $this->mailerService = $mailerService;
        $this->demoAddressEmail = 'demo@ft4a.fr';

        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('email', InputArgument::OPTIONAL, 'Address email', $this->demoAddressEmail)

        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');

        $io->title('Test email by Inky :');
        $io->note(sprintf('Send to email : %s', $email));

        $this->mailerService->send(
            ['noreply@ft4a.fr', 'ft4a - Noreply'],
            $email,
            'ft4a.fr - Noreply',
            'demo/email.html.twig',
            'demo/email.txt.twig',
            [

            ]
        );

        return Command::SUCCESS;
    }
}
