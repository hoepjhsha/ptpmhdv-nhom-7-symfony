<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241207101243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_history ADD COLUMN order_items CLOB NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__order_history AS SELECT id, user_id_id, total_price, created_at FROM order_history');
        $this->addSql('DROP TABLE order_history');
        $this->addSql('CREATE TABLE order_history (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id_id INTEGER NOT NULL, total_price NUMERIC(65, 2) NOT NULL, created_at DATETIME NOT NULL, CONSTRAINT FK_D1C0D9009D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO order_history (id, user_id_id, total_price, created_at) SELECT id, user_id_id, total_price, created_at FROM __temp__order_history');
        $this->addSql('DROP TABLE __temp__order_history');
        $this->addSql('CREATE INDEX IDX_D1C0D9009D86650F ON order_history (user_id_id)');
    }
}
