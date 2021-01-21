<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210120191013 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE controle_qualite (id INT AUTO_INCREMENT NOT NULL, commande_fournisseur_id INT DEFAULT NULL, num_controle INT NOT NULL, date_controle DATE NOT NULL, UNIQUE INDEX UNIQ_78240C2EA2577AA5 (commande_fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE controle_qualite ADD CONSTRAINT FK_78240C2EA2577AA5 FOREIGN KEY (commande_fournisseur_id) REFERENCES commande_fournisseur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE controle_qualite');
    }
}
