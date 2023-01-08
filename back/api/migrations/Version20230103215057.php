<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230103215057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE cart_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE customer_order_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_order_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE cart (id INT NOT NULL, customer_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA388B79395C3F3 ON cart (customer_id)');
        $this->addSql('CREATE TABLE customer_order (id INT NOT NULL, customer_id INT NOT NULL, status VARCHAR(255) NOT NULL, total_price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3B1CE6A39395C3F3 ON customer_order (customer_id)');
        $this->addSql('CREATE TABLE product_order (id INT NOT NULL, customer_order_id INT DEFAULT NULL, cart_id INT DEFAULT NULL, product_id INT NOT NULL, quantity INT NOT NULL, discount INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5475E8C4A15A2E17 ON product_order (customer_order_id)');
        $this->addSql('CREATE INDEX IDX_5475E8C41AD5CDBF ON product_order (cart_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B79395C3F3 FOREIGN KEY (customer_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer_order ADD CONSTRAINT FK_3B1CE6A39395C3F3 FOREIGN KEY (customer_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_order ADD CONSTRAINT FK_5475E8C4A15A2E17 FOREIGN KEY (customer_order_id) REFERENCES customer_order (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_order ADD CONSTRAINT FK_5475E8C41AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE cart_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE customer_order_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_order_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE cart DROP CONSTRAINT FK_BA388B79395C3F3');
        $this->addSql('ALTER TABLE customer_order DROP CONSTRAINT FK_3B1CE6A39395C3F3');
        $this->addSql('ALTER TABLE product_order DROP CONSTRAINT FK_5475E8C4A15A2E17');
        $this->addSql('ALTER TABLE product_order DROP CONSTRAINT FK_5475E8C41AD5CDBF');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE customer_order');
        $this->addSql('DROP TABLE product_order');
        $this->addSql('DROP TABLE "user"');
    }
}
