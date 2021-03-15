<?php

namespace App\Command;

use App\Entity\Legacy\BlogCats;
use App\Entity\Category;
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
class LegacyImportCategoryCommand extends AbstractCommand
{
    protected static $defaultName = 'legacy:import:categories';
    protected static $defaultDescription = 'Legacy imports categories';
    protected static $defaultTable = Category::class;


    /**
     * LegacyImportCategoryCommand constructor.
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

        $blogCategories = $this->getMangerLegacy()
            ->getRepository(BlogCats::class)
            ->findAll();

        $io->note(sprintf('Number of licenses collected : %d', count($blogCategories)));

        $progressBar = new ProgressBar($output);

        $i = 0;

        foreach ($progressBar->iterate($blogCategories) as $blogCategory) {
            $Category = new Category();
            $Category->setTitle($blogCategory->getCategorytitle());
            $Category->setSlug($blogCategory->getCategorytitle());

            $this->getManagerCurrent()->persist($Category);

            $i++;
        }

        $this->getManagerCurrent()->flush();
        $this->getManagerCurrent()->clear();

        $progressBar->finish();

        $io->newLine(2);
        $io->note(sprintf('Number of categories inserted : %d', $i));

        $io->success('Registered categories.');

        return Command::SUCCESS;
    }
}
