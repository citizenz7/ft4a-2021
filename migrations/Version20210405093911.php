<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210405093911 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE torrent_file ADD torrent_id INT NOT NULL');
        $this->addSql('ALTER TABLE torrent_file ADD CONSTRAINT FK_77F5C74A9162822 FOREIGN KEY (torrent_id) REFERENCES torrent (id)');
        $this->addSql('CREATE INDEX IDX_77F5C74A9162822 ON torrent_file (torrent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE torrent_file DROP FOREIGN KEY FK_77F5C74A9162822');
        $this->addSql('DROP INDEX IDX_77F5C74A9162822 ON torrent_file');
        $this->addSql('ALTER TABLE torrent_file DROP torrent_id');
    }
}
