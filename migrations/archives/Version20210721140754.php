<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210721140754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cartline (id INT AUTO_INCREMENT NOT NULL, panier_id INT NOT NULL, produit_id INT NOT NULL, quantity INT DEFAULT NULL, INDEX IDX_AC6FBE4FF77D927C (panier_id), INDEX IDX_AC6FBE4FF347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cartline ADD CONSTRAINT FK_AC6FBE4FF77D927C FOREIGN KEY (panier_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE cartline ADD CONSTRAINT FK_AC6FBE4FF347EFB FOREIGN KEY (produit_id) REFERENCES product (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cartline');
    }
}
