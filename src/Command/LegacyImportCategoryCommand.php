<?php

namespace App\Command;

use App\Entity\Legacy\BlogCats;
use App\Entity\Category;
use Doctrine\DBAL\Driver\Connection;
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
 * Class LegacyImportCategoryCommand
 * @package App\Command
 */
class LegacyImportCategoryCommand extends AbstractLegacyCommand
{
    protected static $defaultName = 'legacy:import:categories';
    protected static $defaultDescription = 'Legacy imports categories';
    protected static $defaultTable = Category::class;

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

        $this->truncateTable(self::$defaultTable, $io);

        $sql = "SELECT * FROM `$database`.`blog_cats`";
        $blogCategories = $this->getOldData($sql);

        $io->note(sprintf('Number of licenses collected : %d', count($blogCategories)));

        $progressBar = new ProgressBar($output);

        $i = 0;
        /** @var $blogCategory $blogCategory */
        foreach ($progressBar->iterate($blogCategories) as $blogCategory) {
            $Category = new Category();
            $title = $blogCategory['catTitle'];
            $Category->setTitle($title);
            $Category->setSlug($title);

            $this->getManager()->persist($Category);

            $i++;
        }

        $this->getManager()->flush();
        $this->getManager()->clear();

        $progressBar->finish();

        $io->newLine(2);
        $io->note(sprintf('Number of categories inserted : %d', $i));

        $io->success('Registered categories.');

        return Command::SUCCESS;
    }
}
