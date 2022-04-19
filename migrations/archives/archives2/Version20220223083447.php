<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220223083447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favorite_company (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, company_id INT NOT NULL, INDEX IDX_12EBA721A76ED395 (user_id), INDEX IDX_12EBA721979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favorite_company ADD CONSTRAINT FK_12EBA721A76ED395 FOREIGN KEY (user_id) REFERENCES userrv (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorite_company ADD CONSTRAINT FK_12EBA721979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE favoritecompany');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favoritecompany (id INT NOT NULL, date DATE NOT NULL, idCompany INT NOT NULL, idUser INT NOT NULL, INDEX IDX_8A3982365F0662BD (idCompany), INDEX IDX_8A398236FE6E88D7 (idUser), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE favorite_company');
    }
}
