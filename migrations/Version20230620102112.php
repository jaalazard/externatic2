<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230620102112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation ADD establishment VARCHAR(255) NOT NULL, ADD diploma VARCHAR(255) NOT NULL, DROP etablissement, DROP diplome');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation ADD etablissement VARCHAR(255) NOT NULL, ADD diplome VARCHAR(255) NOT NULL, DROP establishment, DROP diploma');
    }
}
