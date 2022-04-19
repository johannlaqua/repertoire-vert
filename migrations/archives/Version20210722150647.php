<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210722150647 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FBF396750 FOREIGN KEY (id) REFERENCES userRV (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_category ADD CONSTRAINT FK_1EDB0CAC979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_category ADD CONSTRAINT FK_1EDB0CAC12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_fav ADD CONSTRAINT FK_72686407A76ED395 FOREIGN KEY (user_id) REFERENCES userRV (id)');
        $this->addSql('ALTER TABLE company_fav ADD CONSTRAINT FK_72686407979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE depense ADD CONSTRAINT FK_34059757FAD8DA84 FOREIGN KEY (createur) REFERENCES userRV (id)');
        $this->addSql('ALTER TABLE discussion ADD CONSTRAINT FK_C0B9F90F6804FB49 FOREIGN KEY (recipient) REFERENCES userRV (id)');
        $this->addSql('ALTER TABLE discussion ADD CONSTRAINT FK_C0B9F90F5F004ACF FOREIGN KEY (sender) REFERENCES userRV (id)');
        $this->addSql('ALTER TABLE discussionquote ADD CONSTRAINT FK_133A17D9E19D9AD2 FOREIGN KEY (service) REFERENCES serviceofferuser (id)');
        $this->addSql('ALTER TABLE discussionquote ADD CONSTRAINT FK_133A17D95F004ACF FOREIGN KEY (sender) REFERENCES userRV (id)');
        $this->addSql('ALTER TABLE discussionquote ADD CONSTRAINT FK_133A17D96804FB49 FOREIGN KEY (recipient) REFERENCES userRV (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FBF396750');
        $this->addSql('ALTER TABLE company_category DROP FOREIGN KEY FK_1EDB0CAC979B1AD6');
        $this->addSql('ALTER TABLE company_category DROP FOREIGN KEY FK_1EDB0CAC12469DE2');
        $this->addSql('ALTER TABLE company_fav DROP FOREIGN KEY FK_72686407A76ED395');
        $this->addSql('ALTER TABLE company_fav DROP FOREIGN KEY FK_72686407979B1AD6');
        $this->addSql('ALTER TABLE depense DROP FOREIGN KEY FK_34059757FAD8DA84');
        $this->addSql('ALTER TABLE discussion DROP FOREIGN KEY FK_C0B9F90F6804FB49');
        $this->addSql('ALTER TABLE discussion DROP FOREIGN KEY FK_C0B9F90F5F004ACF');
        $this->addSql('ALTER TABLE discussionquote DROP FOREIGN KEY FK_133A17D9E19D9AD2');
        $this->addSql('ALTER TABLE discussionquote DROP FOREIGN KEY FK_133A17D95F004ACF');
        $this->addSql('ALTER TABLE discussionquote DROP FOREIGN KEY FK_133A17D96804FB49');
    }
}
