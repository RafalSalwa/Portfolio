<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231215201549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE tech_item_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE stack_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE stack_item (id INT NOT NULL, application_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_138B6FE83E030ACD ON stack_item (application_id)');
        $this->addSql('ALTER TABLE stack_item ADD CONSTRAINT FK_138B6FE83E030ACD FOREIGN KEY (application_id) REFERENCES application (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tech_item DROP CONSTRAINT fk_9a851ff3e030acd');
        $this->addSql('DROP TABLE tech_item');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE stack_item_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE tech_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tech_item (id INT NOT NULL, application_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_9a851ff3e030acd ON tech_item (application_id)');
        $this->addSql('ALTER TABLE tech_item ADD CONSTRAINT fk_9a851ff3e030acd FOREIGN KEY (application_id) REFERENCES application (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE stack_item DROP CONSTRAINT FK_138B6FE83E030ACD');
        $this->addSql('DROP TABLE stack_item');
    }
}
