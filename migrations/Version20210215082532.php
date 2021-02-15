<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210215082532 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE members ADD pid INT NOT NULL, ADD date DATETIME NOT NULL, ADD avatar VARCHAR(255) DEFAULT NULL, ADD signature VARCHAR(255) DEFAULT NULL, ADD active TINYINT(1) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_45A0D2FFE7927C74 ON members (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_45A0D2FF5550C4ED ON members (pid)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_45A0D2FF1677722F ON members (avatar)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_45A0D2FFE7927C74 ON members');
        $this->addSql('DROP INDEX UNIQ_45A0D2FF5550C4ED ON members');
        $this->addSql('DROP INDEX UNIQ_45A0D2FF1677722F ON members');
        $this->addSql('ALTER TABLE members DROP pid, DROP date, DROP avatar, DROP signature, DROP active');
    }
}
