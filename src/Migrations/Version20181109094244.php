<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181109094244 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attendance (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, teacher_id INT DEFAULT NULL, status VARCHAR(255) NOT NULL, remarks LONGTEXT DEFAULT NULL, date DATE NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_6DE30D91CB944F1A (student_id), INDEX IDX_6DE30D9141807E1D (teacher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_student (id INT AUTO_INCREMENT NOT NULL, uuid VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, middle_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, birthday DATE NOT NULL, address LONGTEXT NOT NULL, guardian VARCHAR(255) DEFAULT NULL, guardian_contact VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_EF2EB139D17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, uuid VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, middle_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, email VARCHAR(255) DEFAULT NULL, mobile_number VARCHAR(255) DEFAULT NULL, address LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_8D93D649D17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attendance ADD CONSTRAINT FK_6DE30D91CB944F1A FOREIGN KEY (student_id) REFERENCES user_student (id)');
        $this->addSql('ALTER TABLE attendance ADD CONSTRAINT FK_6DE30D9141807E1D FOREIGN KEY (teacher_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE attendance DROP FOREIGN KEY FK_6DE30D91CB944F1A');
        $this->addSql('ALTER TABLE attendance DROP FOREIGN KEY FK_6DE30D9141807E1D');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE attendance');
        $this->addSql('DROP TABLE user_student');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE subject');
    }
}
