<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220307142339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE get_user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(40) NOT NULL, email VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news_letter_user (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, nom VARCHAR(40) NOT NULL, prenom VARCHAR(40) NOT NULL, mail VARCHAR(40) NOT NULL, ville VARCHAR(40) NOT NULL, code_postal VARCHAR(40) NOT NULL, UNIQUE INDEX UNIQ_23175F1C9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE news_letter_user ADD CONSTRAINT FK_23175F1C9D86650F FOREIGN KEY (user_id_id) REFERENCES userrv (id)');
        $this->addSql('ALTER TABLE category CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE category_subcategory ADD CONSTRAINT FK_BA47E62312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_subcategory ADD CONSTRAINT FK_BA47E6235DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategory (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentreport CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE commentreport ADD CONSTRAINT FK_E02106DFF8697D13 FOREIGN KEY (comment_id) REFERENCES postcomment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentreport ADD CONSTRAINT FK_E02106DFA76ED395 FOREIGN KEY (user_id) REFERENCES userrv (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment_product_fav CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE communauty DROP FOREIGN KEY FK_35C81BD6FAD8DA84');
        $this->addSql('ALTER TABLE communauty ADD CONSTRAINT FK_35C81BD6FAD8DA84 FOREIGN KEY (createur) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FBF396750 FOREIGN KEY (id) REFERENCES userrv (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_category ADD CONSTRAINT FK_1EDB0CAC979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_category ADD CONSTRAINT FK_1EDB0CAC12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_fav CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE company_fav ADD CONSTRAINT FK_72686407A76ED395 FOREIGN KEY (user_id) REFERENCES userrv (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_fav ADD CONSTRAINT FK_72686407979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_favoris CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE coup_de_projecteur CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE cssstyle CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE depense CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE depense ADD CONSTRAINT FK_34059757FAD8DA84 FOREIGN KEY (createur) REFERENCES userrv (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE discussion CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE discussion ADD CONSTRAINT FK_C0B9F90F6804FB49 FOREIGN KEY (recipient) REFERENCES userrv (id)');
        $this->addSql('ALTER TABLE discussion ADD CONSTRAINT FK_C0B9F90F5F004ACF FOREIGN KEY (sender) REFERENCES userrv (id)');
        $this->addSql('ALTER TABLE discussionquote CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE discussionquote ADD CONSTRAINT FK_133A17D9E19D9AD2 FOREIGN KEY (service) REFERENCES serviceofferuser (id)');
        $this->addSql('ALTER TABLE discussionquote ADD CONSTRAINT FK_133A17D95F004ACF FOREIGN KEY (sender) REFERENCES userrv (id)');
        $this->addSql('ALTER TABLE discussionquote ADD CONSTRAINT FK_133A17D96804FB49 FOREIGN KEY (recipient) REFERENCES userrv (id)');
        $this->addSql('ALTER TABLE event CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7A76ED395 FOREIGN KEY (user_id) REFERENCES userrv (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_fav CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE event_fav ADD CONSTRAINT FK_675425BCA76ED395 FOREIGN KEY (user_id) REFERENCES userrv (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_fav ADD CONSTRAINT FK_675425BC71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favoriteproduct CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE favoriteproduct ADD CONSTRAINT FK_16CC8FD4C3F36F5F FOREIGN KEY (idProduct) REFERENCES product (id)');
        $this->addSql('ALTER TABLE favoriteproduct ADD CONSTRAINT FK_16CC8FD4FE6E88D7 FOREIGN KEY (idUser) REFERENCES userrv (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE forumads CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE friendship ADD CONSTRAINT FK_7234A45F8D93D649 FOREIGN KEY (user) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE friendship ADD CONSTRAINT FK_7234A45F55EEAC61 FOREIGN KEY (friend) REFERENCES person (id)');
        $this->addSql('ALTER TABLE invention CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE locations CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE news CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CAF624B39D');
        $this->addSql('DROP INDEX fk_bf5476caf624b39d ON notification');
        $this->addSql('CREATE INDEX IDX_BF5476CAF624B39D ON notification (sender_id)');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CAF624B39D FOREIGN KEY (sender_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE page CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_182BA9BA115E1BBE');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_182BA9BAEE06EE26');
        $this->addSql('DROP INDEX idx_182ba9baee06ee26 ON participation');
        $this->addSql('CREATE INDEX IDX_AB55E24F62671590 ON participation (covoiturage_id)');
        $this->addSql('DROP INDEX idx_182ba9ba115e1bbe ON participation');
        $this->addSql('CREATE INDEX IDX_AB55E24F9D1C3019 ON participation (participant_id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_182BA9BA115E1BBE FOREIGN KEY (participant_id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_182BA9BAEE06EE26 FOREIGN KEY (covoiturage_id) REFERENCES communauty (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176BF396750 FOREIGN KEY (id) REFERENCES userrv (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DBC06EA63 FOREIGN KEY (creator) REFERENCES userrv (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_comment_like ADD CONSTRAINT FK_21689F8C61220EA6 FOREIGN KEY (creator_id) REFERENCES userrv (id)');
        $this->addSql('ALTER TABLE post_comment_like ADD CONSTRAINT FK_21689F8CF8697D13 FOREIGN KEY (comment_id) REFERENCES postcomment (id)');
        $this->addSql('ALTER TABLE postcategory CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE postcomment ADD CONSTRAINT FK_5D65518ABC06EA63 FOREIGN KEY (creator) REFERENCES userrv (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE postcomment ADD CONSTRAINT FK_5D65518A5A8A6C8D FOREIGN KEY (post) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE postlike CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE postlike ADD CONSTRAINT FK_B84FD43ABC06EA63 FOREIGN KEY (creator) REFERENCES userrv (id)');
        $this->addSql('ALTER TABLE postlike ADD CONSTRAINT FK_B84FD43A5A8A6C8D FOREIGN KEY (post) REFERENCES post (id)');
        $this->addSql('ALTER TABLE productads CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE product_click ADD CONSTRAINT FK_1BAAB97C4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_click ADD CONSTRAINT FK_1BAAB97C979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_fav ADD CONSTRAINT FK_96B4B470A76ED395 FOREIGN KEY (user_id) REFERENCES userrv (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_fav ADD CONSTRAINT FK_96B4B4704584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE productcomment CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE productcomment ADD CONSTRAINT FK_F3BF44BBC06EA63 FOREIGN KEY (creator) REFERENCES userrv (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE productcomment ADD CONSTRAINT FK_F3BF44BD34A04AD FOREIGN KEY (product) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784BC06EA63 FOREIGN KEY (creator) REFERENCES userrv (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serviceoffercategories CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE serviceoffercategories ADD CONSTRAINT FK_BB59A884FBF094F FOREIGN KEY (company) REFERENCES userrv (id)');
        $this->addSql('ALTER TABLE serviceofferuser CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE serviceofferuser ADD CONSTRAINT FK_3B7BB076E19D9AD2 FOREIGN KEY (service) REFERENCES services (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serviceofferuser ADD CONSTRAINT FK_3B7BB0768D93D649 FOREIGN KEY (user) REFERENCES userrv (id)');
        $this->addSql('ALTER TABLE serviceofferuser ADD CONSTRAINT FK_3B7BB0764FBF094F FOREIGN KEY (company) REFERENCES userrv (id)');
        $this->addSql('ALTER TABLE services CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE services ADD CONSTRAINT FK_7332E1694FBF094F FOREIGN KEY (company) REFERENCES userrv (id)');
        $this->addSql('ALTER TABLE services ADD CONSTRAINT FK_7332E169497DD634 FOREIGN KEY (categorie) REFERENCES serviceoffercategories (id)');
        $this->addSql('ALTER TABLE sucess_story CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE tag CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE tarifads CHANGE id id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE tarifadsuser CHANGE id id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE tarifadsuser ADD CONSTRAINT FK_753A672DE7189C9 FOREIGN KEY (tarif) REFERENCES tarifads (id)');
        $this->addSql('ALTER TABLE tarifadsuser ADD CONSTRAINT FK_753A672D8D93D649 FOREIGN KEY (user) REFERENCES userrv (id)');
        $this->addSql('ALTER TABLE tarifadsuser ADD CONSTRAINT FK_753A672DEA302AF FOREIGN KEY (adv) REFERENCES ads (id)');
        $this->addSql('CREATE INDEX IDX_753A672DE7189C9 ON tarifadsuser (tarif)');
        $this->addSql('CREATE INDEX IDX_753A672D8D93D649 ON tarifadsuser (user)');
        $this->addSql('CREATE INDEX IDX_753A672DEA302AF ON tarifadsuser (adv)');
        $this->addSql('ALTER TABLE userrv CHANGE username username VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ABBDD3BCFCBBE24F ON userrv (gaeaUserId)');
        $this->addSql('ALTER TABLE fav_company ADD CONSTRAINT FK_30AF0FDDA76ED395 FOREIGN KEY (user_id) REFERENCES userrv (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fav_company ADD CONSTRAINT FK_30AF0FDD979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE visite CHANGE id id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBB979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_B09C8CBB979B1AD6 ON visite (company_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE get_user');
        $this->addSql('DROP TABLE news_letter_user');
        $this->addSql('ALTER TABLE category CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE category_subcategory DROP FOREIGN KEY FK_BA47E62312469DE2');
        $this->addSql('ALTER TABLE category_subcategory DROP FOREIGN KEY FK_BA47E6235DC6FE57');
        $this->addSql('ALTER TABLE comment_product_fav CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE commentReport DROP FOREIGN KEY FK_E02106DFF8697D13');
        $this->addSql('ALTER TABLE commentReport DROP FOREIGN KEY FK_E02106DFA76ED395');
        $this->addSql('ALTER TABLE commentReport CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE communauty DROP FOREIGN KEY FK_35C81BD6FAD8DA84');
        $this->addSql('ALTER TABLE communauty ADD CONSTRAINT FK_35C81BD6FAD8DA84 FOREIGN KEY (createur) REFERENCES userrv (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FBF396750');
        $this->addSql('ALTER TABLE company_category DROP FOREIGN KEY FK_1EDB0CAC979B1AD6');
        $this->addSql('ALTER TABLE company_category DROP FOREIGN KEY FK_1EDB0CAC12469DE2');
        $this->addSql('ALTER TABLE company_fav DROP FOREIGN KEY FK_72686407A76ED395');
        $this->addSql('ALTER TABLE company_fav DROP FOREIGN KEY FK_72686407979B1AD6');
        $this->addSql('ALTER TABLE company_fav CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE company_favoris CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE coup_de_projecteur CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE cssstyle CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE depense DROP FOREIGN KEY FK_34059757FAD8DA84');
        $this->addSql('ALTER TABLE depense CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE discussion DROP FOREIGN KEY FK_C0B9F90F6804FB49');
        $this->addSql('ALTER TABLE discussion DROP FOREIGN KEY FK_C0B9F90F5F004ACF');
        $this->addSql('ALTER TABLE discussion CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE discussionquote DROP FOREIGN KEY FK_133A17D9E19D9AD2');
        $this->addSql('ALTER TABLE discussionquote DROP FOREIGN KEY FK_133A17D95F004ACF');
        $this->addSql('ALTER TABLE discussionquote DROP FOREIGN KEY FK_133A17D96804FB49');
        $this->addSql('ALTER TABLE discussionquote CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7A76ED395');
        $this->addSql('ALTER TABLE event CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE event_fav DROP FOREIGN KEY FK_675425BCA76ED395');
        $this->addSql('ALTER TABLE event_fav DROP FOREIGN KEY FK_675425BC71F7E88B');
        $this->addSql('ALTER TABLE event_fav CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE fav_company DROP FOREIGN KEY FK_30AF0FDDA76ED395');
        $this->addSql('ALTER TABLE fav_company DROP FOREIGN KEY FK_30AF0FDD979B1AD6');
        $this->addSql('ALTER TABLE favoriteproduct DROP FOREIGN KEY FK_16CC8FD4C3F36F5F');
        $this->addSql('ALTER TABLE favoriteproduct DROP FOREIGN KEY FK_16CC8FD4FE6E88D7');
        $this->addSql('ALTER TABLE favoriteproduct CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE forumads CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE friendship DROP FOREIGN KEY FK_7234A45F8D93D649');
        $this->addSql('ALTER TABLE friendship DROP FOREIGN KEY FK_7234A45F55EEAC61');
        $this->addSql('ALTER TABLE invention CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE locations CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE news CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CAF624B39D');
        $this->addSql('DROP INDEX idx_bf5476caf624b39d ON notification');
        $this->addSql('CREATE INDEX FK_BF5476CAF624B39D ON notification (sender_id)');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CAF624B39D FOREIGN KEY (sender_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE page CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F62671590');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F9D1C3019');
        $this->addSql('DROP INDEX idx_ab55e24f62671590 ON participation');
        $this->addSql('CREATE INDEX IDX_182BA9BAEE06EE26 ON participation (covoiturage_id)');
        $this->addSql('DROP INDEX idx_ab55e24f9d1c3019 ON participation');
        $this->addSql('CREATE INDEX IDX_182BA9BA115E1BBE ON participation (participant_id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F62671590 FOREIGN KEY (covoiturage_id) REFERENCES communauty (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F9D1C3019 FOREIGN KEY (participant_id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176BF396750');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DBC06EA63');
        $this->addSql('ALTER TABLE post_comment_like DROP FOREIGN KEY FK_21689F8C61220EA6');
        $this->addSql('ALTER TABLE post_comment_like DROP FOREIGN KEY FK_21689F8CF8697D13');
        $this->addSql('ALTER TABLE postcategory CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE postcomment DROP FOREIGN KEY FK_5D65518ABC06EA63');
        $this->addSql('ALTER TABLE postcomment DROP FOREIGN KEY FK_5D65518A5A8A6C8D');
        $this->addSql('ALTER TABLE postlike DROP FOREIGN KEY FK_B84FD43ABC06EA63');
        $this->addSql('ALTER TABLE postlike DROP FOREIGN KEY FK_B84FD43A5A8A6C8D');
        $this->addSql('ALTER TABLE postlike CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE product_click DROP FOREIGN KEY FK_1BAAB97C4584665A');
        $this->addSql('ALTER TABLE product_click DROP FOREIGN KEY FK_1BAAB97C979B1AD6');
        $this->addSql('ALTER TABLE product_fav DROP FOREIGN KEY FK_96B4B470A76ED395');
        $this->addSql('ALTER TABLE product_fav DROP FOREIGN KEY FK_96B4B4704584665A');
        $this->addSql('ALTER TABLE productAds CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE productcomment DROP FOREIGN KEY FK_F3BF44BBC06EA63');
        $this->addSql('ALTER TABLE productcomment DROP FOREIGN KEY FK_F3BF44BD34A04AD');
        $this->addSql('ALTER TABLE productcomment CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784BC06EA63');
        $this->addSql('ALTER TABLE serviceoffercategories DROP FOREIGN KEY FK_BB59A884FBF094F');
        $this->addSql('ALTER TABLE serviceoffercategories CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE serviceofferuser DROP FOREIGN KEY FK_3B7BB076E19D9AD2');
        $this->addSql('ALTER TABLE serviceofferuser DROP FOREIGN KEY FK_3B7BB0768D93D649');
        $this->addSql('ALTER TABLE serviceofferuser DROP FOREIGN KEY FK_3B7BB0764FBF094F');
        $this->addSql('ALTER TABLE serviceofferuser CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE services DROP FOREIGN KEY FK_7332E1694FBF094F');
        $this->addSql('ALTER TABLE services DROP FOREIGN KEY FK_7332E169497DD634');
        $this->addSql('ALTER TABLE services CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE sucess_story CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE tag CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE tarifads MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE tarifads DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE tarifads CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE tarifadsuser MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE tarifadsuser DROP FOREIGN KEY FK_753A672DE7189C9');
        $this->addSql('ALTER TABLE tarifadsuser DROP FOREIGN KEY FK_753A672D8D93D649');
        $this->addSql('ALTER TABLE tarifadsuser DROP FOREIGN KEY FK_753A672DEA302AF');
        $this->addSql('DROP INDEX IDX_753A672DE7189C9 ON tarifadsuser');
        $this->addSql('DROP INDEX IDX_753A672D8D93D649 ON tarifadsuser');
        $this->addSql('DROP INDEX IDX_753A672DEA302AF ON tarifadsuser');
        $this->addSql('ALTER TABLE tarifadsuser DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE tarifadsuser CHANGE id id INT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_ABBDD3BCFCBBE24F ON userrv');
        $this->addSql('ALTER TABLE userrv CHANGE username username VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE visite MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBB979B1AD6');
        $this->addSql('DROP INDEX IDX_B09C8CBB979B1AD6 ON visite');
        $this->addSql('ALTER TABLE visite DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE visite CHANGE id id INT NOT NULL');
    }
}
