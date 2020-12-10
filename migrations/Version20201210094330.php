<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201210094330 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_9F8C007996901F54');
        $this->addSql('DROP INDEX UNIQ_9F8C0079227BAFE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__checks AS SELECT id, datetime, summa, indef, fp, number FROM checks');
        $this->addSql('DROP TABLE checks');
        $this->addSql('CREATE TABLE checks (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, summa INTEGER NOT NULL, indef INTEGER NOT NULL, fp INTEGER NOT NULL, number INTEGER NOT NULL, datetime VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO checks (id, datetime, summa, indef, fp, number) SELECT id, datetime, summa, indef, fp, number FROM __temp__checks');
        $this->addSql('DROP TABLE __temp__checks');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9F8C0079227BAFE2 ON checks (fp)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_9F8C0079227BAFE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__checks AS SELECT id, datetime, summa, indef, fp, number FROM checks');
        $this->addSql('DROP TABLE checks');
        $this->addSql('CREATE TABLE checks (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, summa INTEGER NOT NULL, indef INTEGER NOT NULL, fp INTEGER NOT NULL, number INTEGER NOT NULL, datetime DATETIME NOT NULL)');
        $this->addSql('INSERT INTO checks (id, datetime, summa, indef, fp, number) SELECT id, datetime, summa, indef, fp, number FROM __temp__checks');
        $this->addSql('DROP TABLE __temp__checks');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9F8C0079227BAFE2 ON checks (fp)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9F8C007996901F54 ON checks (number)');
    }
}
