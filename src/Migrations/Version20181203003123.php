<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181203003123 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE event_student (event_id INT NOT NULL, student_id INT NOT NULL, INDEX IDX_3274069C71F7E88B (event_id), INDEX IDX_3274069CCB944F1A (student_id), PRIMARY KEY(event_id, student_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_student ADD CONSTRAINT FK_3274069C71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_student ADD CONSTRAINT FK_3274069CCB944F1A FOREIGN KEY (student_id) REFERENCES user_student (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE homework');
        $this->addSql('ALTER TABLE event ADD teacher_id INT DEFAULT NULL, CHANGE remarks description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA741807E1D FOREIGN KEY (teacher_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA741807E1D ON event (teacher_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE homework (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, description LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, submission_date DATE NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE event_student');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA741807E1D');
        $this->addSql('DROP INDEX IDX_3BAE0AA741807E1D ON event');
        $this->addSql('ALTER TABLE event DROP teacher_id, CHANGE description remarks LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
