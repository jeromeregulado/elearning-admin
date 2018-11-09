<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181109101049 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE student_section (student_id INT NOT NULL, section_id INT NOT NULL, INDEX IDX_C045CF17CB944F1A (student_id), INDEX IDX_C045CF17D823E37A (section_id), PRIMARY KEY(student_id, section_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE student_section ADD CONSTRAINT FK_C045CF17CB944F1A FOREIGN KEY (student_id) REFERENCES user_student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_section ADD CONSTRAINT FK_C045CF17D823E37A FOREIGN KEY (section_id) REFERENCES section (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE student_section');
    }
}
