<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210313101103 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Initial Schema';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, color VARCHAR(7) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, torrent_id INT DEFAULT NULL, parent_id INT DEFAULT NULL, content LONGTEXT NOT NULL, date DATETIME NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_9474526CF675F31B (author_id), INDEX IDX_9474526C9162822 (torrent_id), INDEX IDX_9474526C727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE licence (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, color VARCHAR(7) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(50) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, pid VARCHAR(50) NOT NULL, last_login DATETIME NOT NULL, registration DATETIME NOT NULL, avatar VARCHAR(255) DEFAULT NULL, signature VARCHAR(255) DEFAULT NULL, is_active TINYINT(1) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_70E4FA78F85E0677 (username), UNIQUE INDEX UNIQ_70E4FA78E7927C74 (email), UNIQUE INDEX UNIQ_70E4FA785550C4ED (pid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE torrent (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, hash VARCHAR(40) NOT NULL, link VARCHAR(255) DEFAULT NULL, content LONGTEXT NOT NULL, size BIGINT NOT NULL, torrent_file VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, views INT NOT NULL, description LONGTEXT NOT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_DCC7B7B6F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE torrent_category (torrent_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_A38747599162822 (torrent_id), INDEX IDX_A387475912469DE2 (category_id), PRIMARY KEY(torrent_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE torrent_licence (torrent_id INT NOT NULL, licence_id INT NOT NULL, INDEX IDX_DC41156F9162822 (torrent_id), INDEX IDX_DC41156F26EF07C9 (licence_id), PRIMARY KEY(torrent_id, licence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C9162822 FOREIGN KEY (torrent_id) REFERENCES torrent (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C727ACA70 FOREIGN KEY (parent_id) REFERENCES comment (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE torrent ADD CONSTRAINT FK_DCC7B7B6F675F31B FOREIGN KEY (author_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE torrent_category ADD CONSTRAINT FK_A38747599162822 FOREIGN KEY (torrent_id) REFERENCES torrent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE torrent_category ADD CONSTRAINT FK_A387475912469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE torrent_licence ADD CONSTRAINT FK_DC41156F9162822 FOREIGN KEY (torrent_id) REFERENCES torrent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE torrent_licence ADD CONSTRAINT FK_DC41156F26EF07C9 FOREIGN KEY (licence_id) REFERENCES licence (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE torrent_category DROP FOREIGN KEY FK_A387475912469DE2');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C727ACA70');
        $this->addSql('ALTER TABLE torrent_licence DROP FOREIGN KEY FK_DC41156F26EF07C9');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF675F31B');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE torrent DROP FOREIGN KEY FK_DCC7B7B6F675F31B');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C9162822');
        $this->addSql('ALTER TABLE torrent_category DROP FOREIGN KEY FK_A38747599162822');
        $this->addSql('ALTER TABLE torrent_licence DROP FOREIGN KEY FK_DC41156F9162822');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE licence');
        $this->addSql('DROP TABLE member');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE torrent');
        $this->addSql('DROP TABLE torrent_category');
        $this->addSql('DROP TABLE torrent_licence');
    }
}
