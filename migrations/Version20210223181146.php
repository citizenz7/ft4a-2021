<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210223181146 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, torrent_id INT DEFAULT NULL, parent_id INT DEFAULT NULL, content LONGTEXT NOT NULL, date DATETIME NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_5F9E962AF675F31B (author_id), INDEX IDX_5F9E962A9162822 (torrent_id), INDEX IDX_5F9E962A727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE licences (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE members (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(50) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, pid VARCHAR(50) NOT NULL, date DATETIME NOT NULL, avatar VARCHAR(255) DEFAULT NULL, signature VARCHAR(255) DEFAULT NULL, active TINYINT(1) DEFAULT \'1\' NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_45A0D2FFF85E0677 (username), UNIQUE INDEX UNIQ_45A0D2FFE7927C74 (email), UNIQUE INDEX UNIQ_45A0D2FF5550C4ED (pid), UNIQUE INDEX UNIQ_45A0D2FF1677722F (avatar), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE torrents (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, hash VARCHAR(40) NOT NULL, link VARCHAR(255) DEFAULT NULL, content LONGTEXT NOT NULL, size BIGINT NOT NULL, date DATETIME NOT NULL, torrent_file VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, views INT NOT NULL, INDEX IDX_39D01E05F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE torrents_categories (torrents_id INT NOT NULL, categories_id INT NOT NULL, INDEX IDX_9F0DA2663218EAE9 (torrents_id), INDEX IDX_9F0DA266A21214B7 (categories_id), PRIMARY KEY(torrents_id, categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE torrents_licences (torrents_id INT NOT NULL, licences_id INT NOT NULL, INDEX IDX_E6C4DA593218EAE9 (torrents_id), INDEX IDX_E6C4DA595EF2836 (licences_id), PRIMARY KEY(torrents_id, licences_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AF675F31B FOREIGN KEY (author_id) REFERENCES members (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A9162822 FOREIGN KEY (torrent_id) REFERENCES torrents (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A727ACA70 FOREIGN KEY (parent_id) REFERENCES comments (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES members (id)');
        $this->addSql('ALTER TABLE torrents ADD CONSTRAINT FK_39D01E05F675F31B FOREIGN KEY (author_id) REFERENCES members (id)');
        $this->addSql('ALTER TABLE torrents_categories ADD CONSTRAINT FK_9F0DA2663218EAE9 FOREIGN KEY (torrents_id) REFERENCES torrents (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE torrents_categories ADD CONSTRAINT FK_9F0DA266A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE torrents_licences ADD CONSTRAINT FK_E6C4DA593218EAE9 FOREIGN KEY (torrents_id) REFERENCES torrents (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE torrents_licences ADD CONSTRAINT FK_E6C4DA595EF2836 FOREIGN KEY (licences_id) REFERENCES licences (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE torrents_categories DROP FOREIGN KEY FK_9F0DA266A21214B7');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A727ACA70');
        $this->addSql('ALTER TABLE torrents_licences DROP FOREIGN KEY FK_E6C4DA595EF2836');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AF675F31B');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE torrents DROP FOREIGN KEY FK_39D01E05F675F31B');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A9162822');
        $this->addSql('ALTER TABLE torrents_categories DROP FOREIGN KEY FK_9F0DA2663218EAE9');
        $this->addSql('ALTER TABLE torrents_licences DROP FOREIGN KEY FK_E6C4DA593218EAE9');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE licences');
        $this->addSql('DROP TABLE members');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE torrents');
        $this->addSql('DROP TABLE torrents_categories');
        $this->addSql('DROP TABLE torrents_licences');
    }
}
