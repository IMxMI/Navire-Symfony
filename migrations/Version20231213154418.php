<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231213154418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE navire ADD pavillon_id INT NOT NULL');
        $this->addSql('ALTER TABLE navire ADD CONSTRAINT FK_EED10388D2618A0 FOREIGN KEY (pavillon_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_EED10388D2618A0 ON navire (pavillon_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE navire DROP FOREIGN KEY FK_EED10388D2618A0');
        $this->addSql('DROP INDEX IDX_EED10388D2618A0 ON navire');
        $this->addSql('ALTER TABLE navire DROP pavillon_id');
    }
}
