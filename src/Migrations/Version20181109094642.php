<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181109094642 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE task DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE attendance DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE subject DROP created_at, DROP updated_at');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE attendance ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE subject ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE task ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
    }
}
