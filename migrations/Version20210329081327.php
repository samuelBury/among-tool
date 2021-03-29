<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210329081327 extends AbstractMigration
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
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, num_tel VARCHAR(40) NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_client (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, bon_commande_client VARCHAR(255) NOT NULL, date_commande_client DATE NOT NULL, date_livraison_client DATE NOT NULL, active TINYINT(1) DEFAULT \'1\', date_de_reglement DATE DEFAULT NULL, num_facture VARCHAR(255) DEFAULT NULL, date_livraison_demandee_par_client DATE NOT NULL, INDEX IDX_C510FF8019EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_fournisseur (id INT AUTO_INCREMENT NOT NULL, commande_client_id INT NOT NULL, fournisseur_id INT NOT NULL, no_id INT DEFAULT NULL, bon_commande_fournisseur VARCHAR(255) NOT NULL, date_bon_commande DATE NOT NULL, date_livraison_donnee DATE NOT NULL, date_debut_production DATE DEFAULT NULL, date_fin_production DATE DEFAULT NULL, date_remise DATE DEFAULT NULL, INDEX IDX_7F6F4F539E73363 (commande_client_id), UNIQUE INDEX UNIQ_7F6F4F53670C757F (fournisseur_id), INDEX IDX_7F6F4F531A65C546 (no_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE controle_qualite (id INT AUTO_INCREMENT NOT NULL, commande_fournisseur_id INT DEFAULT NULL, num_controle INT NOT NULL, date_controle DATE NOT NULL, UNIQUE INDEX UNIQ_78240C2EA2577AA5 (commande_fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entite (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1A291827A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, tel VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suivie_production (id INT AUTO_INCREMENT NOT NULL, date_mise_en_prod DATE NOT NULL, date_qualite DATE DEFAULT NULL, date_remise DATE DEFAULT NULL, date_expedition DATE DEFAULT NULL, date_livraison DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test_class (id INT AUTO_INCREMENT NOT NULL, x VARCHAR(255) NOT NULL, y INT DEFAULT NULL, z VARCHAR(255) NOT NULL, a DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, code_droit_commande_client VARCHAR(255) NOT NULL, code_droit_test VARCHAR(255) DEFAULT NULL, profil VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_role (user_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_2DE8C6A3A76ED395 (user_id), INDEX IDX_2DE8C6A3D60322AC (role_id), PRIMARY KEY(user_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alarme_user ADD CONSTRAINT FK_30A7FD63B52477C9 FOREIGN KEY (alarme_id) REFERENCES alarme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alarme_user ADD CONSTRAINT FK_30A7FD63A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_client ADD CONSTRAINT FK_C510FF8019EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commande_fournisseur ADD CONSTRAINT FK_7F6F4F539E73363 FOREIGN KEY (commande_client_id) REFERENCES commande_client (id)');
        $this->addSql('ALTER TABLE commande_fournisseur ADD CONSTRAINT FK_7F6F4F53670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE commande_fournisseur ADD CONSTRAINT FK_7F6F4F531A65C546 FOREIGN KEY (no_id) REFERENCES commande_client (id)');
        $this->addSql('ALTER TABLE controle_qualite ADD CONSTRAINT FK_78240C2EA2577AA5 FOREIGN KEY (commande_fournisseur_id) REFERENCES commande_fournisseur (id)');
        $this->addSql('ALTER TABLE entite ADD CONSTRAINT FK_1A291827A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alarme_user DROP FOREIGN KEY FK_30A7FD63B52477C9');
        $this->addSql('ALTER TABLE commande_client DROP FOREIGN KEY FK_C510FF8019EB6921');
        $this->addSql('ALTER TABLE commande_fournisseur DROP FOREIGN KEY FK_7F6F4F539E73363');
        $this->addSql('ALTER TABLE commande_fournisseur DROP FOREIGN KEY FK_7F6F4F531A65C546');
        $this->addSql('ALTER TABLE controle_qualite DROP FOREIGN KEY FK_78240C2EA2577AA5');
        $this->addSql('ALTER TABLE commande_fournisseur DROP FOREIGN KEY FK_7F6F4F53670C757F');
        $this->addSql('ALTER TABLE user_role DROP FOREIGN KEY FK_2DE8C6A3D60322AC');
        $this->addSql('ALTER TABLE alarme_user DROP FOREIGN KEY FK_30A7FD63A76ED395');
        $this->addSql('ALTER TABLE entite DROP FOREIGN KEY FK_1A291827A76ED395');
        $this->addSql('ALTER TABLE user_role DROP FOREIGN KEY FK_2DE8C6A3A76ED395');
        $this->addSql('DROP TABLE alarme');
        $this->addSql('DROP TABLE alarme_user');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande_client');
        $this->addSql('DROP TABLE commande_fournisseur');
        $this->addSql('DROP TABLE controle_qualite');
        $this->addSql('DROP TABLE entite');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE suivie_production');
        $this->addSql('DROP TABLE test_class');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_role');
    }
}
