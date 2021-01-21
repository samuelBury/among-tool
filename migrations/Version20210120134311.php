<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210120134311 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, num_tel VARCHAR(20) NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_client (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, bon_commande_client VARCHAR(255) NOT NULL, date_commande_client DATE NOT NULL, date_livraison_client DATE NOT NULL, active TINYINT(1) DEFAULT \'1\' NOT NULL, date_de_reglement DATE DEFAULT NULL, num_facture VARCHAR(255) DEFAULT NULL, INDEX IDX_C510FF8019EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_fournisseur (id INT AUTO_INCREMENT NOT NULL, commande_client_id INT NOT NULL, fournisseur_id INT NOT NULL, bon_commande_fournisseur VARCHAR(255) NOT NULL, date_bon_commande DATE NOT NULL, date_livraison_donnee DATE NOT NULL, INDEX IDX_7F6F4F539E73363 (commande_client_id), UNIQUE INDEX UNIQ_7F6F4F53670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, tel VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suivie_production (id INT AUTO_INCREMENT NOT NULL, date_mise_en_prod DATE NOT NULL, date_qualite DATE DEFAULT NULL, date_remise DATE DEFAULT NULL, date_expedition DATE DEFAULT NULL, date_livraison DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, code_droit_commande_client INT NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_client ADD CONSTRAINT FK_C510FF8019EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commande_fournisseur ADD CONSTRAINT FK_7F6F4F539E73363 FOREIGN KEY (commande_client_id) REFERENCES commande_client (id)');
        $this->addSql('ALTER TABLE commande_fournisseur ADD CONSTRAINT FK_7F6F4F53670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_client DROP FOREIGN KEY FK_C510FF8019EB6921');
        $this->addSql('ALTER TABLE commande_fournisseur DROP FOREIGN KEY FK_7F6F4F539E73363');
        $this->addSql('ALTER TABLE commande_fournisseur DROP FOREIGN KEY FK_7F6F4F53670C757F');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande_client');
        $this->addSql('DROP TABLE commande_fournisseur');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE suivie_production');
        $this->addSql('DROP TABLE user');
    }
}
