<?php

namespace App\Command;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use ReflectionException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

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
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * LegacyImportLicenceCommand constructor.
     * @param string|null $name
     * @param ManagerRegistry $managerRegistry
     * @param EntityManagerInterface $entityManager
     * @param LoggerInterface $logger
     */
    public function __construct(string $name = null, ManagerRegistry $managerRegistry, EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        parent::__construct($name);

        $this->managerRegistry = $managerRegistry;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    /**
     * @return ObjectManager
     */
    public function getMangerLegacy(): ObjectManager
    {
        return $this->managerRegistry->getManager('legacy');
    }

    /**
     * @return ObjectManager
     */
    public function getManagerCurrent(): ObjectManager
    {
        return $this->managerRegistry->getManager();
    }

    /**
     * Vidange d'une table.
     * @param string $class
     * @param SymfonyStyle $io
     */
    public function truncateTable(string $class, SymfonyStyle $io): void
    {
        $connection = $this->entityManager->getConnection();

        try {
            $connection->executeQuery('SET FOREIGN_KEY_CHECKS = 0;');

            $table = new \ReflectionClass($class);

            $io->note('TRUNCATE TABLE ' . strtolower($table->getShortName()));
            $connection->executeQuery('TRUNCATE TABLE ' . strtolower($table->getShortName()));

            $connection->executeQuery('SET FOREIGN_KEY_CHECKS = 1;');
        } catch (Exception | ReflectionException $exception) {
            $io->block(
                'Une erreur est survenue à la suppression des données dans les tables de la base.',
                LogLevel::CRITICAL,
                'fg=white;bg=red',
                ' ',
                true
            );

            $this->logger->log(LogLevel::CRITICAL, $exception->getMessage(), [
                'exception' => $exception,
            ]);

            Command::FAILURE;

            exit();
        }
    }
}
