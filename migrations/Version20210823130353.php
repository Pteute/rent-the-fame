<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210823130353 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD client_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D19EB6921 ON commande (client_id)');
        $this->addSql('ALTER TABLE detail_commande ADD id_commande_id INT NOT NULL, ADD id_celebrite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail_commande ADD CONSTRAINT FK_98344FA69AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE detail_commande ADD CONSTRAINT FK_98344FA6A41C72C0 FOREIGN KEY (id_celebrite_id) REFERENCES celebrite (id)');
        $this->addSql('CREATE INDEX IDX_98344FA69AF8E3A3 ON detail_commande (id_commande_id)');
        $this->addSql('CREATE INDEX IDX_98344FA6A41C72C0 ON detail_commande (id_celebrite_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D19EB6921');
        $this->addSql('DROP INDEX IDX_6EEAA67D19EB6921 ON commande');
        $this->addSql('ALTER TABLE commande DROP client_id');
        $this->addSql('ALTER TABLE detail_commande DROP FOREIGN KEY FK_98344FA69AF8E3A3');
        $this->addSql('ALTER TABLE detail_commande DROP FOREIGN KEY FK_98344FA6A41C72C0');
        $this->addSql('DROP INDEX IDX_98344FA69AF8E3A3 ON detail_commande');
        $this->addSql('DROP INDEX IDX_98344FA6A41C72C0 ON detail_commande');
        $this->addSql('ALTER TABLE detail_commande DROP id_commande_id, DROP id_celebrite_id');
    }
}
