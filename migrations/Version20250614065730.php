<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250614065730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE demande_acces ADD COLUMN institution VARCHAR(255) NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__demande_acces AS SELECT id, nom_complet, email, telephone, status, sujet, date_soumission FROM demande_acces
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE demande_acces
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE demande_acces (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom_complet VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) DEFAULT NULL, status VARCHAR(255) NOT NULL, sujet VARCHAR(255) NOT NULL, date_soumission DATETIME NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO demande_acces (id, nom_complet, email, telephone, status, sujet, date_soumission) SELECT id, nom_complet, email, telephone, status, sujet, date_soumission FROM __temp__demande_acces
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__demande_acces
        SQL);
    }
}
