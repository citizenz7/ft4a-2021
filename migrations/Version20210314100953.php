<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210314100953 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Initialization Licence table.';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('INSERT INTO licence (title, slug) VALUES ("AGPL", "agpl")');
        $this->addSql('INSERT INTO licence (title, slug) VALUES ("Apache 2.0", "apache-2-0")');
        $this->addSql('INSERT INTO licence (title, slug) VALUES ("BDL SleepyCat", "bdl-sleepycat")');
        $this->addSql('INSERT INTO licence (title, slug) VALUES ("C.C. 0", "c-c-0")');
        $this->addSql('INSERT INTO licence (title, slug) VALUES ("C.C. By", "c-c-by")');
        $this->addSql('INSERT INTO licence (title, slug) VALUES ("C.C. By-Nc", "c-c-by-nc")');
        $this->addSql('INSERT INTO licence (title, slug) VALUES ("C.C. By-Nc-Nd", "c-c-by-nc-nd")');
        $this->addSql('INSERT INTO licence (title, slug) VALUES ("C.C. By-Nc-Sa", "c-c-by-nc-sa")');
        $this->addSql('INSERT INTO licence (title, slug) VALUES ("C.C. By-Nd", "c-c-by-nd")');
        $this->addSql('INSERT INTO licence (title, slug) VALUES ("C.C. By-Sa", "c-c-by-sa")');
        $this->addSql('INSERT INTO licence (title, slug) VALUES ("C.C. Public Domain", "c-c-public-domain")');
        $this->addSql('INSERT INTO licence (title, slug) VALUES ("CeCILL", "cecill")');
        $this->addSql('INSERT INTO licence (title, slug) VALUES ("FreeBSD", "freebsd")');
        $this->addSql('INSERT INTO licence (title, slug) VALUES ("GPL V2", "gpl-v2")');
        $this->addSql('INSERT INTO licence (title, slug) VALUES ("GPL V3", "gpl-v3")');
        $this->addSql('INSERT INTO licence (title, slug) VALUES ("LAL", "lal")');
        $this->addSql('INSERT INTO licence (title, slug) VALUES ("LGPL V2", "lgpl-v2")');
        $this->addSql('INSERT INTO licence (title, slug) VALUES ("LGPL V3", "lgpl-v3")');
        $this->addSql('INSERT INTO licence (title, slug) VALUES ("MIT", "mit")');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DELETE FROM licence WHERE slug="agpl"');
        $this->addSql('DELETE FROM licence WHERE slug="apache-2-0"');
        $this->addSql('DELETE FROM licence WHERE slug="bdl-sleepycat"');
        $this->addSql('DELETE FROM licence WHERE slug="c-c-0"');
        $this->addSql('DELETE FROM licence WHERE slug="c-c-by"');
        $this->addSql('DELETE FROM licence WHERE slug="c-c-by-nc"');
        $this->addSql('DELETE FROM licence WHERE slug="c-c-by-nc-nd"');
        $this->addSql('DELETE FROM licence WHERE slug="c-c-by-nc-sa"');
        $this->addSql('DELETE FROM licence WHERE slug="c-c-by-nd"');
        $this->addSql('DELETE FROM licence WHERE slug="c-c-by-sa"');
        $this->addSql('DELETE FROM licence WHERE slug="c-c-public-domain"');
        $this->addSql('DELETE FROM licence WHERE slug="cecill"');
        $this->addSql('DELETE FROM licence WHERE slug="freebsd"');
        $this->addSql('DELETE FROM licence WHERE slug="gpl-v2"');
        $this->addSql('DELETE FROM licence WHERE slug="gpl-v3"');
        $this->addSql('DELETE FROM licence WHERE slug="mit"');
    }
}
