<?php


namespace App\Command\Maintenance;

use App\Service\Maintenance\MaintenanceModeServiceInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use function is_array;

/**
 * Class AbstractMaintenanceCommand
 * @package App\Command\Maintenance
 */
class AbstractMaintenanceCommand extends Command
{
    protected static $defaultName = 'maintenance:info';
    protected static $defaultDescription = 'Maintenance commands information';

    /**
     * @var MaintenanceModeServiceInterface
     */
    private $mode;

    /**
     * MaintenanceDisableCommand constructor.
     * @param string|null $name
     * @param MaintenanceModeServiceInterface $mode
     */
    public function __construct(string $name = null, MaintenanceModeServiceInterface $mode)
    {
        parent::__construct($name);

        $this->mode = $mode;
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

        $this->maintenanceBlock($io, [MaintenanceEnableCommand::getDefaultName() => MaintenanceEnableCommand::getDefaultDescription()], false);
        $this->maintenanceBlock($io, [MaintenanceDisableCommand::getDefaultName() => MaintenanceDisableCommand::getDefaultDescription()], false);
        $this->maintenanceBlock($io, [MaintenanceStatusCommand::getDefaultName() => MaintenanceStatusCommand::getDefaultDescription()], false);

        return Command::SUCCESS;
    }

    /**
     * @return MaintenanceModeServiceInterface
     */
    public function getModeMaintenance(): MaintenanceModeServiceInterface
    {
        return $this->mode;
    }

    /**
     * @param SymfonyStyle $io
     * @param string|array $message
     * @param bool $padding
     * @param string $prefix
     */
    public function maintenanceBlock(SymfonyStyle $io, $message, bool $padding, string $prefix = ' '): void
    {
        $massage = is_array($message) ? key($message) . ' : ' . reset($message) : [$message];

        $io->block($massage, 'MAINTENANCE', 'fg=magenta', $prefix, $padding);
    }
}
