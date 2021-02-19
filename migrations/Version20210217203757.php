<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210217203757 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE torrents_categories (torrents_id INT NOT NULL, categories_id INT NOT NULL, INDEX IDX_9F0DA2663218EAE9 (torrents_id), INDEX IDX_9F0DA266A21214B7 (categories_id), PRIMARY KEY(torrents_id, categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE torrents_licences (torrents_id INT NOT NULL, licences_id INT NOT NULL, INDEX IDX_E6C4DA593218EAE9 (torrents_id), INDEX IDX_E6C4DA595EF2836 (licences_id), PRIMARY KEY(torrents_id, licences_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE torrents_categories ADD CONSTRAINT FK_9F0DA2663218EAE9 FOREIGN KEY (torrents_id) REFERENCES torrents (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE torrents_categories ADD CONSTRAINT FK_9F0DA266A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE torrents_licences ADD CONSTRAINT FK_E6C4DA593218EAE9 FOREIGN KEY (torrents_id) REFERENCES torrents (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE torrents_licences ADD CONSTRAINT FK_E6C4DA595EF2836 FOREIGN KEY (licences_id) REFERENCES licences (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comments ADD author_id INT NOT NULL, ADD torrent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AF675F31B FOREIGN KEY (author_id) REFERENCES members (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A9162822 FOREIGN KEY (torrent_id) REFERENCES torrents (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962AF675F31B ON comments (author_id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A9162822 ON comments (torrent_id)');
        $this->addSql('ALTER TABLE messages ADD author_send_id INT NOT NULL, ADD author_receive_id INT NOT NULL');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E9656A9A138 FOREIGN KEY (author_send_id) REFERENCES members (id)');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96EB01177 FOREIGN KEY (author_receive_id) REFERENCES members (id)');
        $this->addSql('CREATE INDEX IDX_DB021E9656A9A138 ON messages (author_send_id)');
        $this->addSql('CREATE INDEX IDX_DB021E96EB01177 ON messages (author_receive_id)');
        $this->addSql('ALTER TABLE torrents ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE torrents ADD CONSTRAINT FK_39D01E05F675F31B FOREIGN KEY (author_id) REFERENCES members (id)');
        $this->addSql('CREATE INDEX IDX_39D01E05F675F31B ON torrents (author_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE torrents_categories');
        $this->addSql('DROP TABLE torrents_licences');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AF675F31B');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A9162822');
        $this->addSql('DROP INDEX IDX_5F9E962AF675F31B ON comments');
        $this->addSql('DROP INDEX IDX_5F9E962A9162822 ON comments');
        $this->addSql('ALTER TABLE comments DROP author_id, DROP torrent_id');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E9656A9A138');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96EB01177');
        $this->addSql('DROP INDEX IDX_DB021E9656A9A138 ON messages');
        $this->addSql('DROP INDEX IDX_DB021E96EB01177 ON messages');
        $this->addSql('ALTER TABLE messages DROP author_send_id, DROP author_receive_id');
        $this->addSql('ALTER TABLE torrents DROP FOREIGN KEY FK_39D01E05F675F31B');
        $this->addSql('DROP INDEX IDX_39D01E05F675F31B ON torrents');
        $this->addSql('ALTER TABLE torrents DROP author_id');
    }
}
