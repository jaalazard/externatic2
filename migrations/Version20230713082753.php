<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230713082753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidate_job_offer (candidate_id INT NOT NULL, job_offer_id INT NOT NULL, INDEX IDX_37F1E76291BD8781 (candidate_id), INDEX IDX_37F1E7623481D195 (job_offer_id), PRIMARY KEY(candidate_id, job_offer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_offer_candidate (job_offer_id INT NOT NULL, candidate_id INT NOT NULL, INDEX IDX_80EBBCEF3481D195 (job_offer_id), INDEX IDX_80EBBCEF91BD8781 (candidate_id), PRIMARY KEY(job_offer_id, candidate_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidate_job_offer ADD CONSTRAINT FK_37F1E76291BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidate_job_offer ADD CONSTRAINT FK_37F1E7623481D195 FOREIGN KEY (job_offer_id) REFERENCES job_offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_offer_candidate ADD CONSTRAINT FK_80EBBCEF3481D195 FOREIGN KEY (job_offer_id) REFERENCES job_offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_offer_candidate ADD CONSTRAINT FK_80EBBCEF91BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidate_job_offer DROP FOREIGN KEY FK_37F1E76291BD8781');
        $this->addSql('ALTER TABLE candidate_job_offer DROP FOREIGN KEY FK_37F1E7623481D195');
        $this->addSql('ALTER TABLE job_offer_candidate DROP FOREIGN KEY FK_80EBBCEF3481D195');
        $this->addSql('ALTER TABLE job_offer_candidate DROP FOREIGN KEY FK_80EBBCEF91BD8781');
        $this->addSql('DROP TABLE candidate_job_offer');
        $this->addSql('DROP TABLE job_offer_candidate');
    }
}
