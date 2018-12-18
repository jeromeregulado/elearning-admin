<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181217031501 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE message_thread (id INT AUTO_INCREMENT NOT NULL, teacher_id INT DEFAULT NULL, parent_id INT DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_607D18C41807E1D (teacher_id), INDEX IDX_607D18C727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE message_thread ADD CONSTRAINT FK_607D18C41807E1D FOREIGN KEY (teacher_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message_thread ADD CONSTRAINT FK_607D18C727ACA70 FOREIGN KEY (parent_id) REFERENCES user_student (id)');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F41807E1D');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FCB944F1A');
        $this->addSql('DROP INDEX IDX_B6BD307F41807E1D ON message');
        $this->addSql('DROP INDEX IDX_B6BD307FCB944F1A ON message');
        $this->addSql('ALTER TABLE message ADD thread_id INT DEFAULT NULL, ADD sender_teacher_id INT DEFAULT NULL, ADD sender_parent_id INT DEFAULT NULL, ADD status VARCHAR(255) DEFAULT \'unread\' NOT NULL, DROP teacher_id, DROP student_id');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FE2904019 FOREIGN KEY (thread_id) REFERENCES message_thread (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F150420D0 FOREIGN KEY (sender_teacher_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F28732E86 FOREIGN KEY (sender_parent_id) REFERENCES user_student (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FE2904019 ON message (thread_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F150420D0 ON message (sender_teacher_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F28732E86 ON message (sender_parent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FE2904019');
        $this->addSql('DROP TABLE message_thread');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F150420D0');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F28732E86');
        $this->addSql('DROP INDEX IDX_B6BD307FE2904019 ON message');
        $this->addSql('DROP INDEX IDX_B6BD307F150420D0 ON message');
        $this->addSql('DROP INDEX IDX_B6BD307F28732E86 ON message');
        $this->addSql('ALTER TABLE message ADD teacher_id INT DEFAULT NULL, ADD student_id INT DEFAULT NULL, DROP thread_id, DROP sender_teacher_id, DROP sender_parent_id, DROP status');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F41807E1D FOREIGN KEY (teacher_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FCB944F1A FOREIGN KEY (student_id) REFERENCES user_student (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F41807E1D ON message (teacher_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FCB944F1A ON message (student_id)');
    }
}
