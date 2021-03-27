<?php

namespace App\Command\Maintenance;

use App\Service\Maintenance\MaintenanceModeServiceInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class MaintenanceDisableCommand
 * @package App\Command\Maintenance
 */
class MaintenanceDisableCommand extends AbstractMaintenanceCommand
{
    protected static $defaultName = 'maintenance:disable';
    protected static $defaultDescription = 'Disables maintenance mode';

    /**
     * MaintenanceDisableCommand constructor.
     * @param string|null $name
     * @param MaintenanceModeServiceInterface $mode
     */
    public function __construct(string $name = null, MaintenanceModeServiceInterface $mode)
    {
        parent::__construct($name, $mode);
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

        $this->maintenanceBlock($io, $this->getDescription(), true);
        $this->getModeMaintenance()->disable();

        $io->success('Maintenance mode is DISABLED.');

        return Command::SUCCESS;
    }

    /**
     * @return string
     */
    public static function getDefaultName(): string
    {
        return self::$defaultName;
    }

    /**
     * @return string
     */
    public static function getDefaultDescription(): string
    {
        return self::$defaultDescription;
    }
}
