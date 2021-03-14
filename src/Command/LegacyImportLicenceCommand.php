<?php

namespace App\Command;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
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

    /**
     * @var ManagerRegistry
     */
    private $managerRegistry;

    /**
     * LegacyImportLicenceCommand constructor.
     * @param string|null $name
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(string $name = null, ManagerRegistry $managerRegistry)
    {
        parent::__construct($name, $managerRegistry);
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

        $licences = $this->getMangerLegacy()
            ->getRepository()
            ->findAll();

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
