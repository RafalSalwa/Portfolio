<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231215222522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX idx_a45bddc1b213fa4');
        $this->addSql('ALTER TABLE application ALTER lang_id DROP NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A45BDDC1B213FA4 ON application (lang_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX UNIQ_A45BDDC1B213FA4');
        $this->addSql('ALTER TABLE application ALTER lang_id SET NOT NULL');
        $this->addSql('CREATE INDEX idx_a45bddc1b213fa4 ON application (lang_id)');
    }
}
