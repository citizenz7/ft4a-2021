<?php

namespace App\Command;

use App\Entity\Member;
use Cassandra\Date;
use DateTime;
use Doctrine\DBAL\Driver\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class LegacyImportMemberCommand
 * @package App\Command
 */
class LegacyImportMemberCommand extends AbstractLegacyCommand
{
    protected static $defaultName = 'legacy:import:members';
    protected static $defaultDescription = 'Legacy imports members';
    protected static $defaultTable = Member::class;

    /**
     * @var string
     */
    private $oldDatabase;

    /**
     * LegacyImportLicenceCommand constructor.
     * @param string|null $name
     * @param Connection $connection
     * @param ManagerRegistry $managerRegistry
     * @param EntityManagerInterface $entityManager
     * @param LoggerInterface $logger
     * @param string $oldDatabase
     */
    public function __construct(string $name = null, Connection $connection, ManagerRegistry $managerRegistry, EntityManagerInterface $entityManager, LoggerInterface $logger, string $oldDatabase)
    {
        $this->oldDatabase = $oldDatabase;

        parent::__construct($name, $connection, $managerRegistry, $entityManager, $logger);
    }

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('database', InputArgument::OPTIONAL, 'Name of database', $this->oldDatabase)
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $database = $input->getArgument('database');

        $this->truncateTable(self::$defaultTable, $io);

        $sql = "SELECT * FROM `$database`.`blog_members`";
        $blogMembers = $this->getOldData($sql);

        $io->note(sprintf('Number of members collected : %d', count($blogMembers)));

        $progressBar = new ProgressBar($output);

        $i = 0;
        /** @var $blogCategory $blogCategory */
        foreach ($progressBar->iterate($blogMembers) as $blogMember) {
            $member = new Member();
            $member->setUsername($blogMember['username']);

            //$member->setPassword(password_hash('password', PASSWORD_BCRYPT, ['cost' => 12]));
            $member->setPassword($blogMember['password']);

            $member->setEmail($blogMember['email']);
            $member->setPid($blogMember['pid']);
            $member->setAvatar($blogMember['avatar']);
            $member->setRegistration(new DateTime($blogMember['memberDate']));
            $member->setLastLogin(new DateTime());
            $member->setIsActive($blogMember['active'] === 'yes');
            $member->setIsVerified(true);
            $member->setRoles($blogMember['memberID'] == 1 ? ['ROLE_ADMIN'] : ['ROLE_USER']);

            $this->getManager()->persist($member);

            $i++;
        }

        $this->getManager()->flush();
        $this->getManager()->clear();

        $progressBar->finish();

        $io->newLine(2);
        $io->note(sprintf('Number of members inserted : %d', $i));

        $io->success('Registered members.');

        return Command::SUCCESS;
    }
}
