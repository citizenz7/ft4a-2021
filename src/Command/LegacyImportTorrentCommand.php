<?php

namespace App\Command;

use App\Entity\Member;
use App\Entity\Torrent;
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
 * Class LegacyImportCategoryCommand
 * @package App\Command
 */
class LegacyImportTorrentCommand extends AbstractLegacyCommand
{
    protected static $defaultName = 'legacy:import:torrents';
    protected static $defaultDescription = 'Legacy imports torrents';
    protected static $defaultTable = Torrent::class;

    /**
     * @var string
     */
    private $oldDatabase;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

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
        $this->entityManager = $entityManager;

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

        $sql = "SELECT * FROM `$database`.`blog_posts_seo`";
        $blogPostSeos = $this->getOldData($sql);

        $io->note(sprintf('Number of torrents collected : %d', count($blogPostSeos)));

        $progressBar = new ProgressBar($output);

        $i = 0;
        foreach ($progressBar->iterate($blogPostSeos) as $blogPostSeo) {
            $torrent = new Torrent();
            $title = $blogPostSeo['postTitle'];
            $torrent->setTitle($title);
            $torrent->setSlug($title);
            $torrent->setHash($blogPostSeo['postHash']);
            $torrent->setSize($blogPostSeo['postTaille']);
            $torrent->setViews($blogPostSeo['postViews']);
            $torrent->setImage($blogPostSeo['postImage']);
            $torrent->setLink($blogPostSeo['postLink']);
            $torrent->setTorrentFile($blogPostSeo['postTorrent']);
            $torrent->setCreatedAt(new DateTime($blogPostSeo['postDate']));
            $torrent->setDescription($blogPostSeo['postDesc']);
            $torrent->setContent($blogPostSeo['postCont']);

            $author = $this->entityManager->getRepository(Member::class)->findOneBy(['username' => $blogPostSeo['postAuthor']]);
            $torrent->setAuthor($author);

            $this->getManager()->persist($torrent);

            $i++;
        }

        $this->getManager()->flush();
        $this->getManager()->clear();

        $progressBar->finish();

        $io->newLine(2);
        $io->note(sprintf('Number of torrents inserted : %d', $i));

        $io->success('Registered torrents.');

        return Command::SUCCESS;
    }
}
