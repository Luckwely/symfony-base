<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260922162155 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE instructor_classe (instructor_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_F03F60CA8C4FC193 (instructor_id), INDEX IDX_F03F60CA8F5EA509 (classe_id), PRIMARY KEY (instructor_id, classe_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE instructor_classe ADD CONSTRAINT FK_F03F60CA8C4FC193 FOREIGN KEY (instructor_id) REFERENCES instructor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instructor_classe ADD CONSTRAINT FK_F03F60CA8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE instructor_classe DROP FOREIGN KEY FK_F03F60CA8C4FC193');
        $this->addSql('ALTER TABLE instructor_classe DROP FOREIGN KEY FK_F03F60CA8F5EA509');
        $this->addSql('DROP TABLE instructor_classe');
    }
}
