<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220505181506 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE name name VARCHAR(1024) NOT NULL, CHANGE short_description short_description VARCHAR(10000) DEFAULT NULL, CHANGE description description VARCHAR(10000) DEFAULT NULL, CHANGE image image VARCHAR(4096) DEFAULT NULL, CHANGE date date VARCHAR(1024) DEFAULT NULL');
        $this->addSql('ALTER TABLE page CHANGE content content VARCHAR(50000) DEFAULT NULL');
        $this->addSql('ALTER TABLE page_settings CHANGE main_page main_page VARCHAR(60000) DEFAULT NULL, CHANGE company_text company_text VARCHAR(60000) DEFAULT NULL, CHANGE rates_warning rates_warning VARCHAR(60000) DEFAULT NULL, CHANGE internet_text internet_text VARCHAR(60000) DEFAULT NULL, CHANGE tvbanner tvbanner VARCHAR(4096) DEFAULT NULL, CHANGE tv_warning tv_warning VARCHAR(60000) DEFAULT NULL, CHANGE video_text video_text VARCHAR(60000) DEFAULT NULL, CHANGE support_questions support_questions VARCHAR(60000) DEFAULT NULL, CHANGE support_text support_text VARCHAR(60000) DEFAULT NULL, CHANGE support_image support_image VARCHAR(4096) DEFAULT NULL, CHANGE vacancy_image vacancy_image VARCHAR(1026) DEFAULT NULL, CHANGE vacancy_text vacancy_text VARCHAR(50000) DEFAULT NULL');
        $this->addSql('ALTER TABLE region ADD internet_warning LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news CHANGE id id INT NOT NULL, CHANGE name name TEXT NOT NULL, CHANGE short_description short_description TEXT DEFAULT NULL, CHANGE description description TEXT DEFAULT NULL, CHANGE image image TEXT DEFAULT NULL, CHANGE date date TINYTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE page CHANGE content content MEDIUMTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE page_settings CHANGE main_page main_page MEDIUMTEXT DEFAULT NULL, CHANGE company_text company_text MEDIUMTEXT DEFAULT NULL, CHANGE rates_warning rates_warning MEDIUMTEXT DEFAULT NULL, CHANGE internet_text internet_text MEDIUMTEXT DEFAULT NULL, CHANGE tv_warning tv_warning MEDIUMTEXT DEFAULT NULL, CHANGE video_text video_text MEDIUMTEXT DEFAULT NULL, CHANGE support_questions support_questions MEDIUMTEXT DEFAULT NULL, CHANGE support_text support_text MEDIUMTEXT DEFAULT NULL, CHANGE vacancy_image vacancy_image TEXT DEFAULT NULL, CHANGE vacancy_text vacancy_text TEXT DEFAULT NULL, CHANGE support_image support_image TEXT DEFAULT NULL, CHANGE tvbanner tvbanner TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE region DROP internet_warning');
    }
}
