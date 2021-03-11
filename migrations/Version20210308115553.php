<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210308115553 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alarme (id INT AUTO_INCREMENT NOT NULL, champ_application VARCHAR(255) NOT NULL, delai1 INT NOT NULL, delai2 INT NOT NULL, delai3 INT NOT NULL, champ_controle VARCHAR(255) NOT NULL, role LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE alarme_user (alarme_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_30A7FD63B52477C9 (alarme_id), INDEX IDX_30A7FD63A76ED395 (user_id), PRIMARY KEY(alarme_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alarme_user ADD CONSTRAINT FK_30A7FD63B52477C9 FOREIGN KEY (alarme_id) REFERENCES alarme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alarme_user ADD CONSTRAINT FK_30A7FD63A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE alerte');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alarme_user DROP FOREIGN KEY FK_30A7FD63B52477C9');
        $this->addSql('CREATE TABLE alerte (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, nom_colonne VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, delai_en_jour INT NOT NULL, INDEX IDX_3AE753AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE alerte ADD CONSTRAINT FK_3AE753AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE alarme');
        $this->addSql('DROP TABLE alarme_user');
    }
}
