<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181202004624 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE homework DROP FOREIGN KEY FK_8C600B4E46CB6A73');
        $this->addSql('DROP TABLE advisory');
        $this->addSql('DROP INDEX IDX_8C600B4E46CB6A73 ON homework');
        $this->addSql('ALTER TABLE homework DROP advisory_id');
        $this->addSql('ALTER TABLE user_student ADD teacher_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_student ADD CONSTRAINT FK_EF2EB13941807E1D FOREIGN KEY (teacher_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_EF2EB13941807E1D ON user_student (teacher_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE advisory (id INT AUTO_INCREMENT NOT NULL, section_id INT DEFAULT NULL, teacher_id INT DEFAULT NULL, subject_id INT DEFAULT NULL, INDEX IDX_4112BDD9D823E37A (section_id), INDEX IDX_4112BDD941807E1D (teacher_id), INDEX IDX_4112BDD923EDC87 (subject_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE advisory ADD CONSTRAINT FK_4112BDD923EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE advisory ADD CONSTRAINT FK_4112BDD941807E1D FOREIGN KEY (teacher_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE advisory ADD CONSTRAINT FK_4112BDD9D823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('ALTER TABLE homework ADD advisory_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE homework ADD CONSTRAINT FK_8C600B4E46CB6A73 FOREIGN KEY (advisory_id) REFERENCES advisory (id)');
        $this->addSql('CREATE INDEX IDX_8C600B4E46CB6A73 ON homework (advisory_id)');
        $this->addSql('ALTER TABLE user_student DROP FOREIGN KEY FK_EF2EB13941807E1D');
        $this->addSql('DROP INDEX IDX_EF2EB13941807E1D ON user_student');
        $this->addSql('ALTER TABLE user_student DROP teacher_id');
    }
}
