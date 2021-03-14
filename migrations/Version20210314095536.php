<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210314095536 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Initialization Category table.';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('INSERT INTO category (title, slug) VALUES ("Film", "film")');
        $this->addSql('INSERT INTO category (title, slug) VALUES ("Musique", "musique")');
        $this->addSql('INSERT INTO category (title, slug) VALUES ("Roman", "roman")');
        $this->addSql('INSERT INTO category (title, slug) VALUES ("Application Windows", "application-windows")');
        $this->addSql('INSERT INTO category (title, slug) VALUES ("Application Gnu/Linux", "application-gnu-linux")');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DELETE FROM category WHERE slug="film"');
        $this->addSql('DELETE FROM category WHERE slug="musique"');
        $this->addSql('DELETE FROM category WHERE slug="roman"');
        $this->addSql('DELETE FROM category WHERE slug="application-windows"');
        $this->addSql('DELETE FROM category WHERE slug="application-gnu-linux"');
    }
}
