<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210319184315 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, excerpt LONGTEXT NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE checklist (id INT AUTO_INCREMENT NOT NULL, roadbook_id INT DEFAULT NULL, task VARCHAR(255) NOT NULL, INDEX IDX_5C696D2F7952527A (roadbook_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE information (id INT AUTO_INCREMENT NOT NULL, roadbook_id INT DEFAULT NULL, description LONGTEXT DEFAULT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(180) DEFAULT NULL, phone VARCHAR(45) NOT NULL, INDEX IDX_297918837952527A (roadbook_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roadbook (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, status INT NOT NULL, picture_url VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, trip_start DATETIME NOT NULL, share_link VARCHAR(255) NOT NULL, share_password VARCHAR(255) NOT NULL, INDEX IDX_B31204D7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE step (id INT AUTO_INCREMENT NOT NULL, roadbook_id INT DEFAULT NULL, suggestion_id INT DEFAULT NULL, step_date DATETIME NOT NULL, step_lat DOUBLE PRECISION NOT NULL, step_long DOUBLE PRECISION NOT NULL, title VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_43B9FE3C7952527A (roadbook_id), UNIQUE INDEX UNIQ_43B9FE3CA41BB822 (suggestion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suggestion (id INT AUTO_INCREMENT NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(180) NOT NULL, zip_code VARCHAR(80) NOT NULL, country VARCHAR(255) NOT NULL, phone VARCHAR(45) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, suggest_lat DOUBLE PRECISION NOT NULL, suggest_long DOUBLE PRECISION NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suggestion_category (suggestion_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_514B76A7A41BB822 (suggestion_id), INDEX IDX_514B76A712469DE2 (category_id), PRIMARY KEY(suggestion_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE checklist ADD CONSTRAINT FK_5C696D2F7952527A FOREIGN KEY (roadbook_id) REFERENCES roadbook (id)');
        $this->addSql('ALTER TABLE information ADD CONSTRAINT FK_297918837952527A FOREIGN KEY (roadbook_id) REFERENCES roadbook (id)');
        $this->addSql('ALTER TABLE roadbook ADD CONSTRAINT FK_B31204D7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE step ADD CONSTRAINT FK_43B9FE3C7952527A FOREIGN KEY (roadbook_id) REFERENCES roadbook (id)');
        $this->addSql('ALTER TABLE step ADD CONSTRAINT FK_43B9FE3CA41BB822 FOREIGN KEY (suggestion_id) REFERENCES suggestion (id)');
        $this->addSql('ALTER TABLE suggestion_category ADD CONSTRAINT FK_514B76A7A41BB822 FOREIGN KEY (suggestion_id) REFERENCES suggestion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE suggestion_category ADD CONSTRAINT FK_514B76A712469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE suggestion_category DROP FOREIGN KEY FK_514B76A712469DE2');
        $this->addSql('ALTER TABLE checklist DROP FOREIGN KEY FK_5C696D2F7952527A');
        $this->addSql('ALTER TABLE information DROP FOREIGN KEY FK_297918837952527A');
        $this->addSql('ALTER TABLE step DROP FOREIGN KEY FK_43B9FE3C7952527A');
        $this->addSql('ALTER TABLE step DROP FOREIGN KEY FK_43B9FE3CA41BB822');
        $this->addSql('ALTER TABLE suggestion_category DROP FOREIGN KEY FK_514B76A7A41BB822');
        $this->addSql('ALTER TABLE roadbook DROP FOREIGN KEY FK_B31204D7A76ED395');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE checklist');
        $this->addSql('DROP TABLE information');
        $this->addSql('DROP TABLE roadbook');
        $this->addSql('DROP TABLE step');
        $this->addSql('DROP TABLE suggestion');
        $this->addSql('DROP TABLE suggestion_category');
        $this->addSql('DROP TABLE user');
    }
}
