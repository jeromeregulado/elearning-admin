<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181130024207 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, date DATE NOT NULL, remarks LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE homework (id INT AUTO_INCREMENT NOT NULL, advisory_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, submission_date DATE NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_8C600B4E46CB6A73 (advisory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lesson (id INT AUTO_INCREMENT NOT NULL, subject_id INT DEFAULT NULL, teacher_id INT DEFAULT NULL, date DATE NOT NULL, file_name VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_F87474F323EDC87 (subject_id), INDEX IDX_F87474F341807E1D (teacher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grades (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, teacher_id INT DEFAULT NULL, task_id INT DEFAULT NULL, subject_id INT DEFAULT NULL, date DATE NOT NULL, INDEX IDX_3AE36110CB944F1A (student_id), INDEX IDX_3AE3611041807E1D (teacher_id), INDEX IDX_3AE361108DB60186 (task_id), INDEX IDX_3AE3611023EDC87 (subject_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, teacher_id INT DEFAULT NULL, student_id INT DEFAULT NULL, message LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_B6BD307F41807E1D (teacher_id), INDEX IDX_B6BD307FCB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, teacher_id INT DEFAULT NULL, date DATE NOT NULL, file_name VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_AC74095ACB944F1A (student_id), INDEX IDX_AC74095A41807E1D (teacher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE homework ADD CONSTRAINT FK_8C600B4E46CB6A73 FOREIGN KEY (advisory_id) REFERENCES advisory (id)');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F323EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F341807E1D FOREIGN KEY (teacher_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE grades ADD CONSTRAINT FK_3AE36110CB944F1A FOREIGN KEY (student_id) REFERENCES user_student (id)');
        $this->addSql('ALTER TABLE grades ADD CONSTRAINT FK_3AE3611041807E1D FOREIGN KEY (teacher_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE grades ADD CONSTRAINT FK_3AE361108DB60186 FOREIGN KEY (task_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE grades ADD CONSTRAINT FK_3AE3611023EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F41807E1D FOREIGN KEY (teacher_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FCB944F1A FOREIGN KEY (student_id) REFERENCES user_student (id)');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095ACB944F1A FOREIGN KEY (student_id) REFERENCES user_student (id)');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A41807E1D FOREIGN KEY (teacher_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE homework');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('DROP TABLE grades');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE activity');
    }
}
