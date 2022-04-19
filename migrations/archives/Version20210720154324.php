<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210720154324 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_182BA9BAEE06EE26 FOREIGN KEY (idcovoiturage) REFERENCES communauty (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_182BA9BA115E1BBE FOREIGN KEY (idparticipant) REFERENCES userRV (id)');
        $this->addSql('ALTER TABLE activitiesdisplay ADD CONSTRAINT FK_EAFB9F6DCF60E67C FOREIGN KEY (owner) REFERENCES userRV (id)');
        $this->addSql('ALTER TABLE ads ADD CONSTRAINT FK_7EC9F620BC06EA63 FOREIGN KEY (creator) REFERENCES userRV (id)');
        $this->addSql('ALTER TABLE ads ADD CONSTRAINT FK_7EC9F62064D218E FOREIGN KEY (location_id) REFERENCES locations (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7D34A04AD FOREIGN KEY (product) REFERENCES product (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7BC06EA63 FOREIGN KEY (creator) REFERENCES userRV (id)');
        $this->addSql('ALTER TABLE category_subcategory ADD CONSTRAINT FK_BA47E62312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_subcategory ADD CONSTRAINT FK_BA47E6235DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategory (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentreport ADD CONSTRAINT FK_E02106DFF8697D13 FOREIGN KEY (comment_id) REFERENCES postcomment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentreport ADD CONSTRAINT FK_E02106DFA76ED395 FOREIGN KEY (user_id) REFERENCES userRV (id)');
        $this->addSql('ALTER TABLE communauty CHANGE departuredate departuredate DATETIME NOT NULL, CHANGE heuredepart heuredepart DATETIME NOT NULL');
        $this->addSql('ALTER TABLE communauty ADD CONSTRAINT FK_35C81BD6FAD8DA84 FOREIGN KEY (createur) REFERENCES userRV (id)');
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
        $this->addSql('ALTER TABLE activitiesdisplay DROP FOREIGN KEY FK_EAFB9F6DCF60E67C');
        $this->addSql('ALTER TABLE ads DROP FOREIGN KEY FK_7EC9F620BC06EA63');
        $this->addSql('ALTER TABLE ads DROP FOREIGN KEY FK_7EC9F62064D218E');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7D34A04AD');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7BC06EA63');
        $this->addSql('ALTER TABLE category_subcategory DROP FOREIGN KEY FK_BA47E62312469DE2');
        $this->addSql('ALTER TABLE category_subcategory DROP FOREIGN KEY FK_BA47E6235DC6FE57');
        $this->addSql('ALTER TABLE commentReport DROP FOREIGN KEY FK_E02106DFF8697D13');
        $this->addSql('ALTER TABLE commentReport DROP FOREIGN KEY FK_E02106DFA76ED395');
        $this->addSql('ALTER TABLE communauty DROP FOREIGN KEY FK_35C81BD6FAD8DA84');
        $this->addSql('ALTER TABLE communauty CHANGE departuredate departuredate DATE NOT NULL, CHANGE heuredepart heuredepart TIME NOT NULL');
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
        $this->addSql('ALTER TABLE Participation DROP FOREIGN KEY FK_182BA9BAEE06EE26');
        $this->addSql('ALTER TABLE Participation DROP FOREIGN KEY FK_182BA9BA115E1BBE');
    }
}
