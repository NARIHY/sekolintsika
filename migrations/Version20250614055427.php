<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250614055427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE annee_detude (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date_ou_commence_lanne DATETIME NOT NULL, date_ou_termine_lannee_detude DATETIME NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE classe (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, programme_id INTEGER DEFAULT NULL, annee_detude_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME DEFAULT NULL, CONSTRAINT FK_8F87BF9662BB7AEE FOREIGN KEY (programme_id) REFERENCES programme (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8F87BF96652EB1AF FOREIGN KEY (annee_detude_id) REFERENCES annee_detude (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8F87BF9662BB7AEE ON classe (programme_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8F87BF96652EB1AF ON classe (annee_detude_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE etudiant (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, classe_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenon VARCHAR(255) NOT NULL, matricule VARCHAR(255) NOT NULL, date_de_naissance DATETIME NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME DEFAULT NULL, CONSTRAINT FK_717E22E38F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_717E22E38F5EA509 ON etudiant (classe_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE institut (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE niveau_etude (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, institut_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME DEFAULT NULL, CONSTRAINT FK_F8B95B42ACF64F5F FOREIGN KEY (institut_id) REFERENCES institut (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_F8B95B42ACF64F5F ON niveau_etude (institut_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE personnel (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenon VARCHAR(255) NOT NULL, matricule VARCHAR(255) NOT NULL, fonction VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE programme (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, niveau_id INTEGER DEFAULT NULL, intitule VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME DEFAULT NULL, CONSTRAINT FK_3DDCB9FFB3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau_etude (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_3DDCB9FFB3E9C81 ON programme (niveau_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE unite_enseignement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, classe_id INTEGER DEFAULT NULL, titre VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME DEFAULT NULL, CONSTRAINT FK_46D07C4F8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_46D07C4F8F5EA509 ON unite_enseignement (classe_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE annee_detude
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE classe
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE etudiant
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE institut
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE niveau_etude
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE personnel
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE programme
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE unite_enseignement
        SQL);
    }
}
