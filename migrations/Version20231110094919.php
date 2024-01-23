<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231110094919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pasosexpedientes ADD CONSTRAINT FK_D0A30F2B972EE7E1 FOREIGN KEY (numeroexpediente) REFERENCES regexpedientes (kodea)');
        $this->addSql('CREATE INDEX IDX_D0A30F2B972EE7E1 ON pasosexpedientes (numeroexpediente)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pasosexpedientes DROP FOREIGN KEY FK_D0A30F2B972EE7E1');
        $this->addSql('DROP INDEX IDX_D0A30F2B972EE7E1 ON pasosexpedientes');
    }
}
