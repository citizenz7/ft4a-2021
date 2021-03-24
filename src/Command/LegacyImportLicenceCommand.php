<?php

namespace App\Command;

use App\Entity\Licence;
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
 * Class LegacyImportLicenceCommand
 * @package App\Command
 */
class LegacyImportLicenceCommand extends AbstractLegacyCommand
{
    protected static $defaultName = 'legacy:import:licences';
    protected static $defaultDescription = 'Legacy imports licences';
    protected static $defaultTable = Licence::class;

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
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $database = $input->getArgument('database');

        $sql = "SELECT * FROM `$database`.`blog_licences`";
        $blogLicences = $this->getOldData($sql);

        $this->truncateTable(self::$defaultTable, $io);

        $io->note(sprintf('Number of licenses collected : %d', count($blogLicences)));

        $progressBar = new ProgressBar($output);

        $i = 0;
        foreach ($progressBar->iterate($blogLicences) as $blogLicence) {
            $licence = new Licence();
            $title = $blogLicence['licenceTitle'];
            $licence->setTitle($title);
            $licence->setSlug($title);

            $this->getManager()->persist($licence);

            $i++;
        }

        $this->getManager()->flush();
        $this->getManager()->clear();

        $progressBar->finish();

        $io->newLine(2);
        $io->note(sprintf('Number of licenses inserted : %d', $i));

        $io->success('Registered licenses.');

        return Command::SUCCESS;
    }
}
