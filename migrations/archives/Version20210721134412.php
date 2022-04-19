<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210721134412 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD cart_line_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADB6A1BD45 FOREIGN KEY (cart_line_id) REFERENCES cart_line (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADB6A1BD45 ON product (cart_line_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADB6A1BD45');
        $this->addSql('DROP INDEX IDX_D34A04ADB6A1BD45 ON product');
        $this->addSql('ALTER TABLE product DROP cart_line_id');
    }
}
