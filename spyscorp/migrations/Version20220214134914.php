<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220214134914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23C4B09E92C');
        $this->addSql('DROP INDEX IDX_9067F23C4B09E92C ON mission');
        $this->addSql('ALTER TABLE mission DROP administrator_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE administrator CHANGE last_name last_name VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE first_name first_name VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE agent CHANGE last_name last_name VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE first_name first_name VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE code code VARCHAR(15) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nationality nationality VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE contact CHANGE last_name last_name VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE first_name first_name VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE code code VARCHAR(15) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nationality nationality VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE hideout CHANGE code code VARCHAR(15) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE address address VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE country country VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE type type VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE mission ADD administrator_id INT NOT NULL, CHANGE title title VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE code code VARCHAR(15) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE country country VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE type type VARCHAR(20) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE status status VARCHAR(20) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C4B09E92C FOREIGN KEY (administrator_id) REFERENCES administrator (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_9067F23C4B09E92C ON mission (administrator_id)');
        $this->addSql('ALTER TABLE speciality CHANGE name name VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE target CHANGE last_name last_name VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE first_name first_name VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE code code VARCHAR(15) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nationality nationality VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
