<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201209120111 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cards (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, surname VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, patronymic VARCHAR(255) NOT NULL, date_birth DATETIME NOT NULL, number INTEGER NOT NULL, email VARCHAR(255) NOT NULL, balance INTEGER DEFAULT NULL, id_card VARCHAR(255) NOT NULL, created DATETIME NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C258FDE7927C74 ON cards (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C258FD9D3484D1 ON cards (id_card)');
        $this->addSql('CREATE TABLE checks (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, datetime DATETIME NOT NULL, summa INTEGER NOT NULL, indef INTEGER NOT NULL, fp INTEGER NOT NULL, number INTEGER NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9F8C0079227BAFE2 ON checks (fp)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9F8C007996901F54 ON checks (number)');
        $this->addSql('CREATE TABLE fiscals (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, fnumber INTEGER NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_84419FFB52581856 ON fiscals (fnumber)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cards');
        $this->addSql('DROP TABLE checks');
        $this->addSql('DROP TABLE fiscals');
    }
}
