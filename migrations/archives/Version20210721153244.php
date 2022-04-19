<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210721153244 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cartline ADD produit_id INT NOT NULL');
        $this->addSql('ALTER TABLE cartline ADD CONSTRAINT FK_AC6FBE4FF347EFB FOREIGN KEY (produit_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_AC6FBE4FF347EFB ON cartline (produit_id)');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADBACCF09E');
        $this->addSql('DROP INDEX IDX_D34A04ADBACCF09E ON product');
        $this->addSql('ALTER TABLE product DROP cartline_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cartline DROP FOREIGN KEY FK_AC6FBE4FF347EFB');
        $this->addSql('DROP INDEX IDX_AC6FBE4FF347EFB ON cartline');
        $this->addSql('ALTER TABLE cartline DROP produit_id');
        $this->addSql('ALTER TABLE product ADD cartline_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADBACCF09E FOREIGN KEY (cartline_id) REFERENCES cartline (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADBACCF09E ON product (cartline_id)');
    }
}
