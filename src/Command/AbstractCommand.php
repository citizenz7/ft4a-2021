<?php

namespace App\Command;

use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Console\Command\Command;

/**
 * Class AbstractCommand
 * @package App\Command
 */
class AbstractCommand extends Command
{
    protected static $defaultName = 'legacy:import';
    protected static $defaultDescription = 'Legacy command';

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
        parent::__construct($name);

        $this->managerRegistry = $managerRegistry;
    }

    /**
     * @return ObjectManager
     */
    public function getMangerLegacy(): ObjectManager
    {
        return $this->managerRegistry->getManager('legacy');
    }
}
