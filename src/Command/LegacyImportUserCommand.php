<?php

namespace App\Command;

use App\Entity\Legacy\BlogMembers;
use App\Entity\Member;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


/**
 * Class LegacyImportUserCommand
 * @package App\Command
 */
class LegacyImportUserCommand extends AbstractCommand
{
    protected static $defaultName = 'legacy:import:user';
    protected static $defaultDescription = 'Legacy imports users';
    protected static $defaulTable = Member::class;

    /**
     * LegacyImportUserCommand constructor.
     * @param string|null $name
     * @param ManagerRegistry $managerRegistry
     * @param EntityManagerInterface $entityManager
     * @param LoggerInterface $logger
     */
    public function __construct(string $name = null, ManagerRegistry $managerRegistry, EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        parent::__construct($name, $managerRegistry, $entityManager, $logger);
    }

    protected function configure()
    {
        $this->setDescription(self::$defaultDescription);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $this->truncateTable(self::$defaulTable, $io);

        $blogMembers = $this->getMangerLegacy()
            ->getRepository(BlogMembers::class)
            ->findAll();

        $io->note(sprintf('Number of members collected : %d', count($blogMembers)));

        $progressBar = new ProgressBar($output);

        $i = 0;

        foreach ($progressBar->iterate($blogMembers) as $blogMember) {
            $member = new Member();
            $member->setUsername($blogMember->getUsername);
            $member->setPassword($blogMember->getPassword);
            $member->setEmail($blogMember->getEmail);
            $member->setPid($blogMember->getPid);
            $member->setDate($blogMember->getMemberDate);
            $member->setAvatar($blogMember->getAvatar);
            $member->setIsActive($blogMember->getActive);

            $this->getManagerCurrent()->persist($member);

            $i++;
        }

        $this->getManagerCurrent()->flush();
        $this->getManagerCurrent()->clear();

        $progressBar->finish();

        $io->newLine(2);

        $io->note(sprintf('Number of members inserted : %d', $i));

        $io->success('Registered members.');

        return Command::SUCCESS;
    }
}
