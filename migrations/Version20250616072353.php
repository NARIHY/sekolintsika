<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250616072353 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE annee_detude (id INT AUTO_INCREMENT NOT NULL, date_ou_commence_lanne DATETIME NOT NULL, date_ou_termine_lannee_detude DATETIME NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, programme_id INT DEFAULT NULL, annee_detude_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME DEFAULT NULL, INDEX IDX_8F87BF9662BB7AEE (programme_id), INDEX IDX_8F87BF96652EB1AF (annee_detude_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE demande_acces (id INT AUTO_INCREMENT NOT NULL, nom_complet VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) DEFAULT NULL, status VARCHAR(255) NOT NULL, sujet VARCHAR(255) NOT NULL, date_soumission DATETIME NOT NULL, institution VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, classe_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenon VARCHAR(255) NOT NULL, matricule VARCHAR(255) NOT NULL, date_de_naissance DATETIME NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME DEFAULT NULL, INDEX IDX_717E22E38F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE institut (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE niveau_etude (id INT AUTO_INCREMENT NOT NULL, institut_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME DEFAULT NULL, INDEX IDX_F8B95B42ACF64F5F (institut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE personnel (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenon VARCHAR(255) NOT NULL, matricule VARCHAR(255) NOT NULL, fonction VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE programme (id INT AUTO_INCREMENT NOT NULL, niveau_id INT DEFAULT NULL, intitule VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME DEFAULT NULL, INDEX IDX_3DDCB9FFB3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', expires_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE unite_enseignement (id INT AUTO_INCREMENT NOT NULL, classe_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME DEFAULT NULL, INDEX IDX_46D07C4F8F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT '(DC2Type:json)', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenon VARCHAR(255) NOT NULL, date_activation DATETIME DEFAULT NULL, date_mis_ajour DATETIME DEFAULT NULL, status VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE classe ADD CONSTRAINT FK_8F87BF9662BB7AEE FOREIGN KEY (programme_id) REFERENCES programme (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96652EB1AF FOREIGN KEY (annee_detude_id) REFERENCES annee_detude (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E38F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE niveau_etude ADD CONSTRAINT FK_F8B95B42ACF64F5F FOREIGN KEY (institut_id) REFERENCES institut (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE programme ADD CONSTRAINT FK_3DDCB9FFB3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau_etude (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE unite_enseignement ADD CONSTRAINT FK_46D07C4F8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF9662BB7AEE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96652EB1AF
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E38F5EA509
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE niveau_etude DROP FOREIGN KEY FK_F8B95B42ACF64F5F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE programme DROP FOREIGN KEY FK_3DDCB9FFB3E9C81
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE unite_enseignement DROP FOREIGN KEY FK_46D07C4F8F5EA509
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE annee_detude
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE classe
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE demande_acces
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
            DROP TABLE reset_password_request
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE unite_enseignement
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE `user`
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
