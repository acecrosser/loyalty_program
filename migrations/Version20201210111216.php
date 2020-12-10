<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201210111216 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_4C258FDC5DB6973');
        $this->addSql('DROP INDEX UNIQ_4C258FDE7927C74');
        $this->addSql('CREATE TEMPORARY TABLE __temp__cards AS SELECT id, surname, name, patronymic, date_birth, number, email, balance, created, idcard FROM cards');
        $this->addSql('DROP TABLE cards');
        $this->addSql('CREATE TABLE cards (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, surname VARCHAR(255) NOT NULL COLLATE BINARY, name VARCHAR(255) NOT NULL COLLATE BINARY, patronymic VARCHAR(255) NOT NULL COLLATE BINARY, date_birth DATETIME NOT NULL, number INTEGER NOT NULL, email VARCHAR(255) NOT NULL COLLATE BINARY, balance INTEGER DEFAULT NULL, created DATETIME NOT NULL, idcard VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO cards (id, surname, name, patronymic, date_birth, number, email, balance, created, idcard) SELECT id, surname, name, patronymic, date_birth, number, email, balance, created, idcard FROM __temp__cards');
        $this->addSql('DROP TABLE __temp__cards');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C258FDC5DB6973 ON cards (idcard)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C258FDE7927C74 ON cards (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C258FD96901F54 ON cards (number)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_4C258FD96901F54');
        $this->addSql('DROP INDEX UNIQ_4C258FDE7927C74');
        $this->addSql('DROP INDEX UNIQ_4C258FDC5DB6973');
        $this->addSql('CREATE TEMPORARY TABLE __temp__cards AS SELECT id, surname, name, patronymic, date_birth, number, email, balance, idcard, created FROM cards');
        $this->addSql('DROP TABLE cards');
        $this->addSql('CREATE TABLE cards (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, surname VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, patronymic VARCHAR(255) NOT NULL, date_birth DATETIME NOT NULL, number INTEGER NOT NULL, email VARCHAR(255) NOT NULL, balance INTEGER DEFAULT NULL, idcard VARCHAR(255) NOT NULL, created DATETIME NOT NULL)');
        $this->addSql('INSERT INTO cards (id, surname, name, patronymic, date_birth, number, email, balance, idcard, created) SELECT id, surname, name, patronymic, date_birth, number, email, balance, idcard, created FROM __temp__cards');
        $this->addSql('DROP TABLE __temp__cards');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C258FDE7927C74 ON cards (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C258FDC5DB6973 ON cards (idcard)');
    }
}
