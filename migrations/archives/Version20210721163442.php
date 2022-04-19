<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210721163442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cartline DROP FOREIGN KEY FK_AC6FBE4FF77D927C');
        $this->addSql('ALTER TABLE cartline ADD CONSTRAINT FK_AC6FBE4FF77D927C FOREIGN KEY (panier_id) REFERENCES cart (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cartline DROP FOREIGN KEY FK_AC6FBE4FF77D927C');
        $this->addSql('ALTER TABLE cartline ADD CONSTRAINT FK_AC6FBE4FF77D927C FOREIGN KEY (panier_id) REFERENCES cart (id)');
    }
}
