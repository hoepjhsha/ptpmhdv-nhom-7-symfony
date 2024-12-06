<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241206104456 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__item AS SELECT id, item_category_id, item_code, item_name, item_price, item_image, item_description FROM item');
        $this->addSql('DROP TABLE item');
        $this->addSql('CREATE TABLE item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, item_category_id INTEGER NOT NULL, item_code VARCHAR(255) NOT NULL, item_name VARCHAR(255) NOT NULL, item_price NUMERIC(65, 2) NOT NULL, item_image VARCHAR(255) DEFAULT NULL, item_description CLOB DEFAULT NULL, CONSTRAINT FK_1F1B251EF22EC5D4 FOREIGN KEY (item_category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO item (id, item_category_id, item_code, item_name, item_price, item_image, item_description) SELECT id, item_category_id, item_code, item_name, item_price, item_image, item_description FROM __temp__item');
        $this->addSql('DROP TABLE __temp__item');
        $this->addSql('CREATE INDEX IDX_1F1B251EF22EC5D4 ON item (item_category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__item AS SELECT id, item_category_id, item_code, item_name, item_price, item_image, item_description FROM item');
        $this->addSql('DROP TABLE item');
        $this->addSql('CREATE TABLE item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, item_category_id INTEGER NOT NULL, item_code VARCHAR(255) NOT NULL, item_name VARCHAR(255) NOT NULL, item_price NUMERIC(65, 2) NOT NULL, item_image VARCHAR(255) NOT NULL, item_description CLOB DEFAULT NULL, CONSTRAINT FK_1F1B251EF22EC5D4 FOREIGN KEY (item_category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO item (id, item_category_id, item_code, item_name, item_price, item_image, item_description) SELECT id, item_category_id, item_code, item_name, item_price, item_image, item_description FROM __temp__item');
        $this->addSql('DROP TABLE __temp__item');
        $this->addSql('CREATE INDEX IDX_1F1B251EF22EC5D4 ON item (item_category_id)');
    }
}
