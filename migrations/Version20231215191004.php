<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231215191004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE application_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE application (id INT NOT NULL, name VARCHAR(255) NOT NULL, lang VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, img VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE tech_item ADD application_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tech_item ADD CONSTRAINT FK_9A851FF3E030ACD FOREIGN KEY (application_id) REFERENCES application (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9A851FF3E030ACD ON tech_item (application_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE tech_item DROP CONSTRAINT FK_9A851FF3E030ACD');
        $this->addSql('DROP SEQUENCE application_id_seq CASCADE');
        $this->addSql('DROP TABLE application');
        $this->addSql('DROP INDEX IDX_9A851FF3E030ACD');
        $this->addSql('ALTER TABLE tech_item DROP application_id');
    }
}
