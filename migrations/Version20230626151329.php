<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230626151329 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, candidates_id INT NOT NULL, job_title VARCHAR(255) NOT NULL, company VARCHAR(255) NOT NULL, start DATE NOT NULL, end DATE DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_590C1037D5FB314 (candidates_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C1037D5FB314 FOREIGN KEY (candidates_id) REFERENCES candidate (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C1037D5FB314');
        $this->addSql('DROP TABLE experience');
    }
}
