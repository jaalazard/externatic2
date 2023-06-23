<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230622083925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE business_card ADD category_id INT DEFAULT NULL, DROP category');
        $this->addSql('ALTER TABLE business_card ADD CONSTRAINT FK_468F9ADE12469DE2 FOREIGN KEY (category_id) REFERENCES business_card_category (id)');
        $this->addSql('CREATE INDEX IDX_468F9ADE12469DE2 ON business_card (category_id)');
        $this->addSql('ALTER TABLE company ADD poster VARCHAR(255) DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE business_card DROP FOREIGN KEY FK_468F9ADE12469DE2');
        $this->addSql('DROP INDEX IDX_468F9ADE12469DE2 ON business_card');
        $this->addSql('ALTER TABLE business_card ADD category VARCHAR(255) NOT NULL, DROP category_id');
        $this->addSql('ALTER TABLE company DROP poster, DROP updated_at');
    }
}
