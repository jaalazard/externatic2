<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230624121425 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidate_formation (candidate_id INT NOT NULL, formation_id INT NOT NULL, INDEX IDX_5F3BFC9391BD8781 (candidate_id), INDEX IDX_5F3BFC935200282E (formation_id), PRIMARY KEY(candidate_id, formation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidate_formation ADD CONSTRAINT FK_5F3BFC9391BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidate_formation ADD CONSTRAINT FK_5F3BFC935200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidate_formation DROP FOREIGN KEY FK_5F3BFC9391BD8781');
        $this->addSql('ALTER TABLE candidate_formation DROP FOREIGN KEY FK_5F3BFC935200282E');
        $this->addSql('DROP TABLE candidate_formation');
    }
}
