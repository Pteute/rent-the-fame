<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210823130741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE celebrite_activite (celebrite_id INT NOT NULL, activite_id INT NOT NULL, INDEX IDX_9AEFA9687DD07B2 (celebrite_id), INDEX IDX_9AEFA969B0F88B1 (activite_id), PRIMARY KEY(celebrite_id, activite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE celebrite_activite ADD CONSTRAINT FK_9AEFA9687DD07B2 FOREIGN KEY (celebrite_id) REFERENCES celebrite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE celebrite_activite ADD CONSTRAINT FK_9AEFA969B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE celebrite_activite');
    }
}
