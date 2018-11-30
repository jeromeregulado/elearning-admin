<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181130041136 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEFCB944F1A');
        $this->addSql('DROP INDEX IDX_2D737AEFCB944F1A ON section');
        $this->addSql('ALTER TABLE section DROP student_id');
        $this->addSql('ALTER TABLE user_student ADD section_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_student ADD CONSTRAINT FK_EF2EB139D823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('CREATE INDEX IDX_EF2EB139D823E37A ON user_student (section_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE section ADD student_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEFCB944F1A FOREIGN KEY (student_id) REFERENCES user_student (id)');
        $this->addSql('CREATE INDEX IDX_2D737AEFCB944F1A ON section (student_id)');
        $this->addSql('ALTER TABLE user_student DROP FOREIGN KEY FK_EF2EB139D823E37A');
        $this->addSql('DROP INDEX IDX_EF2EB139D823E37A ON user_student');
        $this->addSql('ALTER TABLE user_student DROP section_id');
    }
}
