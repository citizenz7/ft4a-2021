<?php

namespace App\Command;

use App\Entity\Legacy\BlogLicences;
use App\Entity\Licence;
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
 * Class LegacyImportLicenceCommand
 * @package App\Command
 */
class LegacyImportLicenceCommand extends AbstractCommand
{
    protected static $defaultName = 'legacy:import:licences';
    protected static $defaultDescription = 'Legacy imports licences';
    protected static $defaultTable = Licence::class;

    /**
     * LegacyImportLicenceCommand constructor.
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
        $this
            ->setDescription(self::$defaultDescription)
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

        $this->truncateTable(self::$defaultTable, $io);

        $blogLicences = $this->getMangerLegacy()
            ->getRepository(BlogLicences::class)
            ->findAll();

        $io->note(sprintf('Number of licenses collected : %d', count($blogLicences)));

        $progressBar = new ProgressBar($output);

        $i = 0;
        /** @var BlogLicences $blogLicence */
        foreach ($progressBar->iterate($blogLicences) as $blogLicence) {
            $licence = new Licence();
            $licence->setTitle($blogLicence->getLicencetitle());
            $licence->setSlug($blogLicence->getLicencetitle());

            $this->getManagerCurrent()->persist($licence);

            $i++;
        }

        $this->getManagerCurrent()->flush();
        $this->getManagerCurrent()->clear();

        $progressBar->finish();

        $io->newLine(2);
        $io->note(sprintf('Number of licenses inserted : %d', $i));

        $io->success('Registered licenses.');

        return Command::SUCCESS;
    }
}
