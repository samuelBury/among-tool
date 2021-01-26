<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210122145313 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_client CHANGE date_livraison_demandee_par_client date_livraison_demandee_par_client DATE NOT NULL');
        $this->addSql('ALTER TABLE commande_fournisseur ADD no_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande_fournisseur ADD CONSTRAINT FK_7F6F4F531A65C546 FOREIGN KEY (no_id) REFERENCES commande_client (id)');
        $this->addSql('CREATE INDEX IDX_7F6F4F531A65C546 ON commande_fournisseur (no_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_client CHANGE date_livraison_demandee_par_client date_livraison_demandee_par_client DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE commande_fournisseur DROP FOREIGN KEY FK_7F6F4F531A65C546');
        $this->addSql('DROP INDEX IDX_7F6F4F531A65C546 ON commande_fournisseur');
        $this->addSql('ALTER TABLE commande_fournisseur DROP no_id');
    }
}
