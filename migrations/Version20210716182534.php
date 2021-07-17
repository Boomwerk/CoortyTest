<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210716182534 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animals (id INT AUTO_INCREMENT NOT NULL, name_animals VARCHAR(255) NOT NULL, img_animal VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE animals_country (animals_id INT NOT NULL, country_id INT NOT NULL, INDEX IDX_857D5F71132B9E58 (animals_id), INDEX IDX_857D5F71F92F3E70 (country_id), PRIMARY KEY(animals_id, country_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE breeds (id INT AUTO_INCREMENT NOT NULL, id_animals_id INT NOT NULL, name_breed VARCHAR(255) NOT NULL, size_breed VARCHAR(255) NOT NULL, age_breed INT NOT NULL, img_animal VARCHAR(255) DEFAULT NULL, INDEX IDX_FD953C82B6A11E8F (id_animals_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, country_name VARCHAR(100) NOT NULL, country_img VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, name_department VARCHAR(255) NOT NULL, img_department VARCHAR(255) DEFAULT NULL, INDEX IDX_CD1DE18AF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poeples (id INT AUTO_INCREMENT NOT NULL, id_department_id INT NOT NULL, id_country_id INT NOT NULL, id_animals_id INT NOT NULL, id_breeds_id INT NOT NULL, number_people INT NOT NULL, INDEX IDX_2200675B10A824BA (id_department_id), INDEX IDX_2200675B5CA5BEA7 (id_country_id), INDEX IDX_2200675BB6A11E8F (id_animals_id), INDEX IDX_2200675BF753A830 (id_breeds_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animals_country ADD CONSTRAINT FK_857D5F71132B9E58 FOREIGN KEY (animals_id) REFERENCES animals (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animals_country ADD CONSTRAINT FK_857D5F71F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE breeds ADD CONSTRAINT FK_FD953C82B6A11E8F FOREIGN KEY (id_animals_id) REFERENCES animals (id)');
        $this->addSql('ALTER TABLE department ADD CONSTRAINT FK_CD1DE18AF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE poeples ADD CONSTRAINT FK_2200675B10A824BA FOREIGN KEY (id_department_id) REFERENCES department (id)');
        $this->addSql('ALTER TABLE poeples ADD CONSTRAINT FK_2200675B5CA5BEA7 FOREIGN KEY (id_country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE poeples ADD CONSTRAINT FK_2200675BB6A11E8F FOREIGN KEY (id_animals_id) REFERENCES animals (id)');
        $this->addSql('ALTER TABLE poeples ADD CONSTRAINT FK_2200675BF753A830 FOREIGN KEY (id_breeds_id) REFERENCES breeds (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animals_country DROP FOREIGN KEY FK_857D5F71132B9E58');
        $this->addSql('ALTER TABLE breeds DROP FOREIGN KEY FK_FD953C82B6A11E8F');
        $this->addSql('ALTER TABLE poeples DROP FOREIGN KEY FK_2200675BB6A11E8F');
        $this->addSql('ALTER TABLE poeples DROP FOREIGN KEY FK_2200675BF753A830');
        $this->addSql('ALTER TABLE animals_country DROP FOREIGN KEY FK_857D5F71F92F3E70');
        $this->addSql('ALTER TABLE department DROP FOREIGN KEY FK_CD1DE18AF92F3E70');
        $this->addSql('ALTER TABLE poeples DROP FOREIGN KEY FK_2200675B5CA5BEA7');
        $this->addSql('ALTER TABLE poeples DROP FOREIGN KEY FK_2200675B10A824BA');
        $this->addSql('DROP TABLE animals');
        $this->addSql('DROP TABLE animals_country');
        $this->addSql('DROP TABLE breeds');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE poeples');
    }
}
