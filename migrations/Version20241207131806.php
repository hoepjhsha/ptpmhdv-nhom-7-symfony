<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241207131806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__categories AS SELECT id, category_name FROM categories');
        $this->addSql('DROP TABLE categories');
        $this->addSql('CREATE TABLE categories (id INTEGER NOT NULL, category_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO categories (id, category_name) SELECT id, category_name FROM __temp__categories');
        $this->addSql('DROP TABLE __temp__categories');
        $this->addSql('CREATE TEMPORARY TABLE __temp__order_histories AS SELECT id, user_id, address_id, total_price, created_at, order_items FROM order_histories');
        $this->addSql('DROP TABLE order_histories');
        $this->addSql('CREATE TABLE order_histories (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, address_id INTEGER DEFAULT NULL, total_price NUMERIC(65, 2) NOT NULL, created_at DATETIME NOT NULL, order_items CLOB NOT NULL --(DC2Type:json)
        , CONSTRAINT FK_7376B55BA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_7376B55BF5B7AF75 FOREIGN KEY (address_id) REFERENCES addresses (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO order_histories (id, user_id, address_id, total_price, created_at, order_items) SELECT id, user_id, address_id, total_price, created_at, order_items FROM __temp__order_histories');
        $this->addSql('DROP TABLE __temp__order_histories');
        $this->addSql('CREATE INDEX IDX_7376B55BF5B7AF75 ON order_histories (address_id)');
        $this->addSql('CREATE INDEX IDX_7376B55BA76ED395 ON order_histories (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__categories AS SELECT id, category_name FROM categories');
        $this->addSql('DROP TABLE categories');
        $this->addSql('CREATE TABLE categories (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO categories (id, category_name) SELECT id, category_name FROM __temp__categories');
        $this->addSql('DROP TABLE __temp__categories');
        $this->addSql('CREATE TEMPORARY TABLE __temp__order_histories AS SELECT id, user_id, address_id, total_price, created_at, order_items FROM order_histories');
        $this->addSql('DROP TABLE order_histories');
        $this->addSql('CREATE TABLE order_histories (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, address_id INTEGER NOT NULL, total_price NUMERIC(65, 2) NOT NULL, created_at DATETIME NOT NULL, order_items CLOB NOT NULL --(DC2Type:json)
        , CONSTRAINT FK_7376B55BA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_7376B55BF5B7AF75 FOREIGN KEY (address_id) REFERENCES addresses (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO order_histories (id, user_id, address_id, total_price, created_at, order_items) SELECT id, user_id, address_id, total_price, created_at, order_items FROM __temp__order_histories');
        $this->addSql('DROP TABLE __temp__order_histories');
        $this->addSql('CREATE INDEX IDX_7376B55BA76ED395 ON order_histories (user_id)');
        $this->addSql('CREATE INDEX IDX_7376B55BF5B7AF75 ON order_histories (address_id)');
    }
}
