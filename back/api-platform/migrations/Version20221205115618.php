<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221205115618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_order DROP CONSTRAINT fk_5475e8c44584665a');
        $this->addSql('DROP SEQUENCE product_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_category_id_seq CASCADE');
        $this->addSql('ALTER TABLE cart_product_order DROP CONSTRAINT fk_606dbeaa1ad5cdbf');
        $this->addSql('ALTER TABLE cart_product_order DROP CONSTRAINT fk_606dbeaa462f07af');
        $this->addSql('ALTER TABLE customer_order_product_order DROP CONSTRAINT fk_c57656baa15a2e17');
        $this->addSql('ALTER TABLE customer_order_product_order DROP CONSTRAINT fk_c57656ba462f07af');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT fk_d34a04ad8de820d9');
        $this->addSql('ALTER TABLE product_product_category DROP CONSTRAINT fk_437017aa4584665a');
        $this->addSql('ALTER TABLE product_product_category DROP CONSTRAINT fk_437017aabe6903fd');
        $this->addSql('DROP TABLE cart_product_order');
        $this->addSql('DROP TABLE customer_order_product_order');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_product_category');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('ALTER TABLE customer_order DROP datetime');
        $this->addSql('ALTER TABLE customer_order ALTER customer_id SET NOT NULL');
        $this->addSql('DROP INDEX idx_5475e8c44584665a');
        $this->addSql('ALTER TABLE product_order ADD customer_order_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product_order ADD cart_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product_order ALTER product_id SET NOT NULL');
        $this->addSql('ALTER TABLE product_order ADD CONSTRAINT FK_5475E8C4A15A2E17 FOREIGN KEY (customer_order_id) REFERENCES customer_order (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_order ADD CONSTRAINT FK_5475E8C41AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5475E8C4A15A2E17 ON product_order (customer_order_id)');
        $this->addSql('CREATE INDEX IDX_5475E8C41AD5CDBF ON product_order (cart_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE cart_product_order (cart_id INT NOT NULL, product_order_id INT NOT NULL, PRIMARY KEY(cart_id, product_order_id))');
        $this->addSql('CREATE INDEX idx_606dbeaa462f07af ON cart_product_order (product_order_id)');
        $this->addSql('CREATE INDEX idx_606dbeaa1ad5cdbf ON cart_product_order (cart_id)');
        $this->addSql('CREATE TABLE customer_order_product_order (customer_order_id INT NOT NULL, product_order_id INT NOT NULL, PRIMARY KEY(customer_order_id, product_order_id))');
        $this->addSql('CREATE INDEX idx_c57656ba462f07af ON customer_order_product_order (product_order_id)');
        $this->addSql('CREATE INDEX idx_c57656baa15a2e17 ON customer_order_product_order (customer_order_id)');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, seller_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, stock INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_d34a04ad8de820d9 ON product (seller_id)');
        $this->addSql('CREATE TABLE product_product_category (product_id INT NOT NULL, product_category_id INT NOT NULL, PRIMARY KEY(product_id, product_category_id))');
        $this->addSql('CREATE INDEX idx_437017aabe6903fd ON product_product_category (product_category_id)');
        $this->addSql('CREATE INDEX idx_437017aa4584665a ON product_product_category (product_id)');
        $this->addSql('CREATE TABLE product_category (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE cart_product_order ADD CONSTRAINT fk_606dbeaa1ad5cdbf FOREIGN KEY (cart_id) REFERENCES cart (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cart_product_order ADD CONSTRAINT fk_606dbeaa462f07af FOREIGN KEY (product_order_id) REFERENCES product_order (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer_order_product_order ADD CONSTRAINT fk_c57656baa15a2e17 FOREIGN KEY (customer_order_id) REFERENCES customer_order (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer_order_product_order ADD CONSTRAINT fk_c57656ba462f07af FOREIGN KEY (product_order_id) REFERENCES product_order (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT fk_d34a04ad8de820d9 FOREIGN KEY (seller_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_product_category ADD CONSTRAINT fk_437017aa4584665a FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_product_category ADD CONSTRAINT fk_437017aabe6903fd FOREIGN KEY (product_category_id) REFERENCES product_category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_order DROP CONSTRAINT FK_5475E8C4A15A2E17');
        $this->addSql('ALTER TABLE product_order DROP CONSTRAINT FK_5475E8C41AD5CDBF');
        $this->addSql('DROP INDEX IDX_5475E8C4A15A2E17');
        $this->addSql('DROP INDEX IDX_5475E8C41AD5CDBF');
        $this->addSql('ALTER TABLE product_order DROP customer_order_id');
        $this->addSql('ALTER TABLE product_order DROP cart_id');
        $this->addSql('ALTER TABLE product_order ALTER product_id DROP NOT NULL');
        $this->addSql('ALTER TABLE product_order ADD CONSTRAINT fk_5475e8c44584665a FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_5475e8c44584665a ON product_order (product_id)');
        $this->addSql('ALTER TABLE customer_order ADD datetime DATE NOT NULL');
        $this->addSql('ALTER TABLE customer_order ALTER customer_id DROP NOT NULL');
    }
}
