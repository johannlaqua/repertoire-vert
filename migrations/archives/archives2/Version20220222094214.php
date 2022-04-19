<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220222094214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favorite_category DROP FOREIGN KEY FK_AC1B013012469DE2');
        $this->addSql('ALTER TABLE favorite_category DROP FOREIGN KEY FK_AC1B0130A76ED395');
        $this->addSql('ALTER TABLE favorite_category ADD CONSTRAINT FK_AC1B013012469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorite_category ADD CONSTRAINT FK_AC1B0130A76ED395 FOREIGN KEY (user_id) REFERENCES userrv (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favorite_category DROP FOREIGN KEY FK_AC1B0130A76ED395');
        $this->addSql('ALTER TABLE favorite_category DROP FOREIGN KEY FK_AC1B013012469DE2');
        $this->addSql('ALTER TABLE favorite_category ADD CONSTRAINT FK_AC1B0130A76ED395 FOREIGN KEY (user_id) REFERENCES userrv (id)');
        $this->addSql('ALTER TABLE favorite_category ADD CONSTRAINT FK_AC1B013012469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }
}
