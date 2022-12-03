<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221203143143 extends AbstractMigration
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
        $this->addSql('CREATE SEQUENCE product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_order_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE cart (id INT NOT NULL, customer_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA388B79395C3F3 ON cart (customer_id)');
        $this->addSql('CREATE TABLE cart_product_order (cart_id INT NOT NULL, product_order_id INT NOT NULL, PRIMARY KEY(cart_id, product_order_id))');
        $this->addSql('CREATE INDEX IDX_606DBEAA1AD5CDBF ON cart_product_order (cart_id)');
        $this->addSql('CREATE INDEX IDX_606DBEAA462F07AF ON cart_product_order (product_order_id)');
        $this->addSql('CREATE TABLE customer_order (id INT NOT NULL, customer_id INT DEFAULT NULL, status VARCHAR(255) NOT NULL, total_price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3B1CE6A39395C3F3 ON customer_order (customer_id)');
        $this->addSql('CREATE TABLE customer_order_product_order (customer_order_id INT NOT NULL, product_order_id INT NOT NULL, PRIMARY KEY(customer_order_id, product_order_id))');
        $this->addSql('CREATE INDEX IDX_C57656BAA15A2E17 ON customer_order_product_order (customer_order_id)');
        $this->addSql('CREATE INDEX IDX_C57656BA462F07AF ON customer_order_product_order (product_order_id)');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, seller_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, stock INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D34A04AD8DE820D9 ON product (seller_id)');
        $this->addSql('CREATE TABLE product_product_category (product_id INT NOT NULL, product_category_id INT NOT NULL, PRIMARY KEY(product_id, product_category_id))');
        $this->addSql('CREATE INDEX IDX_437017AA4584665A ON product_product_category (product_id)');
        $this->addSql('CREATE INDEX IDX_437017AABE6903FD ON product_product_category (product_category_id)');
        $this->addSql('CREATE TABLE product_category (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE product_order (id INT NOT NULL, product_id INT DEFAULT NULL, quantity INT NOT NULL, discount INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5475E8C44584665A ON product_order (product_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B79395C3F3 FOREIGN KEY (customer_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cart_product_order ADD CONSTRAINT FK_606DBEAA1AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cart_product_order ADD CONSTRAINT FK_606DBEAA462F07AF FOREIGN KEY (product_order_id) REFERENCES product_order (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer_order ADD CONSTRAINT FK_3B1CE6A39395C3F3 FOREIGN KEY (customer_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer_order_product_order ADD CONSTRAINT FK_C57656BAA15A2E17 FOREIGN KEY (customer_order_id) REFERENCES customer_order (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer_order_product_order ADD CONSTRAINT FK_C57656BA462F07AF FOREIGN KEY (product_order_id) REFERENCES product_order (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD8DE820D9 FOREIGN KEY (seller_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_product_category ADD CONSTRAINT FK_437017AA4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_product_category ADD CONSTRAINT FK_437017AABE6903FD FOREIGN KEY (product_category_id) REFERENCES product_category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_order ADD CONSTRAINT FK_5475E8C44584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE cart_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE customer_order_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_order_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE cart DROP CONSTRAINT FK_BA388B79395C3F3');
        $this->addSql('ALTER TABLE cart_product_order DROP CONSTRAINT FK_606DBEAA1AD5CDBF');
        $this->addSql('ALTER TABLE cart_product_order DROP CONSTRAINT FK_606DBEAA462F07AF');
        $this->addSql('ALTER TABLE customer_order DROP CONSTRAINT FK_3B1CE6A39395C3F3');
        $this->addSql('ALTER TABLE customer_order_product_order DROP CONSTRAINT FK_C57656BAA15A2E17');
        $this->addSql('ALTER TABLE customer_order_product_order DROP CONSTRAINT FK_C57656BA462F07AF');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04AD8DE820D9');
        $this->addSql('ALTER TABLE product_product_category DROP CONSTRAINT FK_437017AA4584665A');
        $this->addSql('ALTER TABLE product_product_category DROP CONSTRAINT FK_437017AABE6903FD');
        $this->addSql('ALTER TABLE product_order DROP CONSTRAINT FK_5475E8C44584665A');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE cart_product_order');
        $this->addSql('DROP TABLE customer_order');
        $this->addSql('DROP TABLE customer_order_product_order');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_product_category');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE product_order');
        $this->addSql('DROP TABLE "user"');
    }
}
