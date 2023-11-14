<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231113141900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE regexpedientes ADD FULLTEXT INDEX idx_descripcion (descripcion)');
        $this->addSql('ALTER TABLE regexpedientes ADD INDEX idx_tipoexpediente (tipoexpediente)');
        $this->addSql('ALTER TABLE regexpedientes ADD INDEX idx_dni (dni)');
        $this->addSql('ALTER TABLE regexpedientes ADD INDEX idx_fechaentrada (fechaentrada)');
        $this->addSql('ALTER TABLE regexpedientes ADD INDEX idx_departamento (departamento)');
        $this->addSql('ALTER TABLE regexpedientes ADD INDEX idx_solicitante (solicitante)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE regexpedientes DROP FULLTEXT INDEX idx_descripcion (descripcion)');
        $this->addSql('ALTER TABLE regexpedientes DROP INDEX idx_tipoexpediente (tipoexpediente)');
        $this->addSql('ALTER TABLE regexpedientes DROP INDEX idx_dni (dni)');
        $this->addSql('ALTER TABLE regexpedientes DROP INDEX idx_fechaentrada (fechaentrada)');
        $this->addSql('ALTER TABLE regexpedientes DROP INDEX idx_departamento (departamento)');
        $this->addSql('ALTER TABLE regexpedientes DROP INDEX idx_solicitante (solicitante)');

    }
}
