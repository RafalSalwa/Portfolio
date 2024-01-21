<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231215193338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE application ADD lang_id INT NOT NULL');
        $this->addSql('ALTER TABLE application DROP lang');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC1B213FA4 FOREIGN KEY (lang_id) REFERENCES lang (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_A45BDDC1B213FA4 ON application (lang_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE application DROP CONSTRAINT FK_A45BDDC1B213FA4');
        $this->addSql('DROP INDEX IDX_A45BDDC1B213FA4');
        $this->addSql('ALTER TABLE application ADD lang VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE application DROP lang_id');
    }
}
