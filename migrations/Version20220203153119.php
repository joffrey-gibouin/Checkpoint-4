<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220203153119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE miamlist (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE miamlist_menu (miamlist_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_98D19DD77D01AC11 (miamlist_id), INDEX IDX_98D19DD7CCD7E912 (menu_id), PRIMARY KEY(miamlist_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE miamlist_menu ADD CONSTRAINT FK_98D19DD77D01AC11 FOREIGN KEY (miamlist_id) REFERENCES miamlist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE miamlist_menu ADD CONSTRAINT FK_98D19DD7CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE miamlist_menu DROP FOREIGN KEY FK_98D19DD77D01AC11');
        $this->addSql('DROP TABLE miamlist');
        $this->addSql('DROP TABLE miamlist_menu');
        $this->addSql('ALTER TABLE ingredient CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE menu CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE nickname nickname VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
