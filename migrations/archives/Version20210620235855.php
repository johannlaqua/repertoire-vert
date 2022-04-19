<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210620235855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Participation (id INT AUTO_INCREMENT NOT NULL, idcovoiturage INT DEFAULT NULL, idparticipant INT DEFAULT NULL, confirmed TINYINT(1) NOT NULL, INDEX IDX_182BA9BAEE06EE26 (idcovoiturage), INDEX IDX_182BA9BA115E1BBE (idparticipant), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Userorder (id INT AUTO_INCREMENT NOT NULL, creator INT DEFAULT NULL, products LONGTEXT NOT NULL, address VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, shipping VARCHAR(255) NOT NULL, total INT NOT NULL, created_at DATE NOT NULL, INDEX IDX_507C2DE9BC06EA63 (creator), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activitiesdisplay (id INT AUTO_INCREMENT NOT NULL, owner INT DEFAULT NULL, display TINYINT(1) NOT NULL, INDEX IDX_EAFB9F6DCF60E67C (owner), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ads (id INT AUTO_INCREMENT NOT NULL, creator INT DEFAULT NULL, location_id INT DEFAULT NULL, created_at DATE NOT NULL, publishdatebegin DATE DEFAULT NULL, publishdateend DATE DEFAULT NULL, photo VARCHAR(5000) NOT NULL, slogan VARCHAR(255) NOT NULL, payed TINYINT(1) NOT NULL, price INT NOT NULL, INDEX IDX_7EC9F620BC06EA63 (creator), INDEX IDX_7EC9F62064D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, product INT DEFAULT NULL, creator INT DEFAULT NULL, created_at DATE NOT NULL, INDEX IDX_BA388B7D34A04AD (product), INDEX IDX_BA388B7BC06EA63 (creator), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image VARCHAR(255) NOT NULL, slug VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_64C19C15E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_subcategory (category_id INT NOT NULL, subcategory_id INT NOT NULL, INDEX IDX_BA47E62312469DE2 (category_id), INDEX IDX_BA47E6235DC6FE57 (subcategory_id), PRIMARY KEY(category_id, subcategory_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentReport (id INT AUTO_INCREMENT NOT NULL, comment_id INT DEFAULT NULL, user_id INT DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_E02106DFF8697D13 (comment_id), INDEX IDX_E02106DFA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment_product_fav (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, product_slug VARCHAR(255) NOT NULL, number INT NOT NULL, company_slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE communauty (id INT AUTO_INCREMENT NOT NULL, createur INT DEFAULT NULL, departure VARCHAR(255) NOT NULL, destination VARCHAR(255) NOT NULL, groupmaxsize INT NOT NULL, departuredate DATETIME NOT NULL, heuredepart DATETIME NOT NULL, INDEX IDX_35C81BD6FAD8DA84 (createur), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT NOT NULL, name VARCHAR(255) NOT NULL, certification VARCHAR(255) DEFAULT NULL, influencezone VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, streetnumber VARCHAR(255) DEFAULT NULL, postcode SMALLINT NOT NULL, city VARCHAR(255) NOT NULL, region VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, wantevaluation TINYINT(1) NOT NULL, description LONGTEXT NOT NULL, vision LONGTEXT NOT NULL, socialreason LONGTEXT NOT NULL, urlwebsite VARCHAR(255) DEFAULT NULL, urlfacebook VARCHAR(255) DEFAULT NULL, urltwitter VARCHAR(255) DEFAULT NULL, urllinkedin VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, starting_date DATE DEFAULT NULL, package SMALLINT DEFAULT NULL, image VARCHAR(255) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longtitude DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_category (company_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_1EDB0CAC979B1AD6 (company_id), INDEX IDX_1EDB0CAC12469DE2 (category_id), PRIMARY KEY(company_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_fav (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, company_id INT NOT NULL, date DATE NOT NULL, INDEX IDX_72686407A76ED395 (user_id), INDEX IDX_72686407979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_favoris (id INT AUTO_INCREMENT NOT NULL, company_slug VARCHAR(255) NOT NULL, number INT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coup_de_projecteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, photo VARCHAR(5000) NOT NULL, video VARCHAR(255) DEFAULT NULL, lien VARCHAR(255) DEFAULT NULL, date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cssstyle (id INT AUTO_INCREMENT NOT NULL, value VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_9EEF829F1D775834 (value), UNIQUE INDEX UNIQ_9EEF829F5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE depense (id INT AUTO_INCREMENT NOT NULL, createur INT DEFAULT NULL, steps INT NOT NULL, co2 INT NOT NULL, calories INT NOT NULL, transporttype VARCHAR(255) NOT NULL, reason VARCHAR(255) NOT NULL, distance INT NOT NULL, geo VARCHAR(255) NOT NULL, createdAt DATE NOT NULL, privacy VARCHAR(255) NOT NULL, INDEX IDX_34059757FAD8DA84 (createur), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE discussion (id INT AUTO_INCREMENT NOT NULL, recipient INT DEFAULT NULL, sender INT DEFAULT NULL, seen TINYINT(1) NOT NULL, message VARCHAR(255) NOT NULL, sent_at DATE NOT NULL, INDEX IDX_C0B9F90F6804FB49 (recipient), INDEX IDX_C0B9F90F5F004ACF (sender), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE discussionquote (id INT AUTO_INCREMENT NOT NULL, service INT DEFAULT NULL, sender INT DEFAULT NULL, recipient INT DEFAULT NULL, date DATE NOT NULL, question VARCHAR(255) NOT NULL, INDEX IDX_133A17D9E19D9AD2 (service), INDEX IDX_133A17D95F004ACF (sender), INDEX IDX_133A17D96804FB49 (recipient), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, starting_date DATE NOT NULL, finish_date DATE NOT NULL, place VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_3BAE0AA7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_fav (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, event_id INT NOT NULL, date DATE DEFAULT NULL, INDEX IDX_675425BCA76ED395 (user_id), INDEX IDX_675425BC71F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favoritecompany (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, idCompany INT DEFAULT NULL, idUser INT DEFAULT NULL, INDEX IDX_8A3982365F0662BD (idCompany), INDEX IDX_8A398236FE6E88D7 (idUser), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favoriteproduct (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, idProduct INT DEFAULT NULL, idUser INT DEFAULT NULL, INDEX IDX_16CC8FD4C3F36F5F (idProduct), INDEX IDX_16CC8FD4FE6E88D7 (idUser), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forumads (id INT AUTO_INCREMENT NOT NULL, profilelink VARCHAR(255) NOT NULL, slogan VARCHAR(255) NOT NULL, companyname VARCHAR(255) NOT NULL, photo VARCHAR(500) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE friendship (id INT AUTO_INCREMENT NOT NULL, user INT DEFAULT NULL, friend INT DEFAULT NULL, is_accepted TINYINT(1) NOT NULL, INDEX IDX_7234A45F8D93D649 (user), INDEX IDX_7234A45F55EEAC61 (friend), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invention (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(300) DEFAULT NULL, description LONGTEXT DEFAULT NULL, lien VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE locations (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_17E64ABA5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marchandise (id INT NOT NULL, packaging VARCHAR(255) DEFAULT NULL, quantity INT DEFAULT NULL, weight INT DEFAULT NULL, weightunit VARCHAR(255) DEFAULT NULL, volume INT DEFAULT NULL, volumeunit VARCHAR(255) DEFAULT NULL, height INT DEFAULT NULL, width INT DEFAULT NULL, depth INT DEFAULT NULL, lengthunit VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(300) NOT NULL, photo LONGTEXT DEFAULT NULL, date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, owner INT DEFAULT NULL, content VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, opened TINYINT(1) NOT NULL, INDEX IDX_BF5476CACF60E67C (owner), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, slug VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_140AB6202B36786B (title), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, street VARCHAR(255) NOT NULL, streetnumber SMALLINT DEFAULT NULL, postcode SMALLINT NOT NULL, city VARCHAR(255) NOT NULL, region VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, category INT DEFAULT NULL, creator INT DEFAULT NULL, title VARCHAR(255) NOT NULL, subtitle VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, views INT NOT NULL, approved TINYINT(1) NOT NULL, photo VARCHAR(500) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_5A8A6C8D64C19C1 (category), INDEX IDX_5A8A6C8DBC06EA63 (creator), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE postcategory (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image VARCHAR(255) NOT NULL, slug VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_4FEC4F8F5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE postcomment (id INT AUTO_INCREMENT NOT NULL, creator INT DEFAULT NULL, post INT DEFAULT NULL, comment LONGTEXT NOT NULL, created_at DATE NOT NULL, INDEX IDX_5D65518ABC06EA63 (creator), INDEX IDX_5D65518A5A8A6C8D (post), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE postlike (id INT AUTO_INCREMENT NOT NULL, creator INT DEFAULT NULL, post INT DEFAULT NULL, created_at DATE NOT NULL, INDEX IDX_B84FD43ABC06EA63 (creator), INDEX IDX_B84FD43A5A8A6C8D (post), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, owner INT DEFAULT NULL, category_id INT DEFAULT NULL, company INT DEFAULT NULL, name VARCHAR(255) NOT NULL, latitude NUMERIC(10, 0) DEFAULT NULL, longitude NUMERIC(10, 0) DEFAULT NULL, description LONGTEXT DEFAULT NULL, origin VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, certification VARCHAR(255) NOT NULL, price NUMERIC(10, 0) DEFAULT NULL, currency VARCHAR(255) DEFAULT NULL, wantevaluation TINYINT(1) NOT NULL, gaearecommanded TINYINT(1) NOT NULL, creation_date DATE NOT NULL, updated_date DATE DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, discr VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D34A04AD5E237E06 (name), INDEX IDX_D34A04ADCF60E67C (owner), INDEX IDX_D34A04AD12469DE2 (category_id), INDEX IDX_D34A04AD4FBF094F (company), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE productAds (id INT AUTO_INCREMENT NOT NULL, profilelink VARCHAR(255) NOT NULL, slogan VARCHAR(255) NOT NULL, companyname VARCHAR(255) NOT NULL, photo VARCHAR(500) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_click (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, product_slug VARCHAR(255) NOT NULL, number INT NOT NULL, company_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_fav (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, product_id INT NOT NULL, date DATE NOT NULL, INDEX IDX_96B4B470A76ED395 (user_id), INDEX IDX_96B4B4704584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE productcomment (id INT AUTO_INCREMENT NOT NULL, creator INT DEFAULT NULL, product INT DEFAULT NULL, comment LONGTEXT NOT NULL, created_at DATE NOT NULL, INDEX IDX_F3BF44BBC06EA63 (creator), INDEX IDX_F3BF44BD34A04AD (product), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE report (id INT AUTO_INCREMENT NOT NULL, owner INT DEFAULT NULL, creator INT DEFAULT NULL, reason VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, reasondetails VARCHAR(255) NOT NULL, urgent TINYINT(1) NOT NULL, decision VARCHAR(255) NOT NULL, INDEX IDX_C42F7784CF60E67C (owner), INDEX IDX_C42F7784BC06EA63 (creator), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, owner INT DEFAULT NULL, creator INT DEFAULT NULL, value INT NOT NULL, INDEX IDX_794381C6CF60E67C (owner), INDEX IDX_794381C6BC06EA63 (creator), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT NOT NULL, serviceduration VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serviceoffercategories (id INT AUTO_INCREMENT NOT NULL, company INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_BB59A884FBF094F (company), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serviceofferuser (id INT AUTO_INCREMENT NOT NULL, service INT DEFAULT NULL, user INT DEFAULT NULL, company INT DEFAULT NULL, field VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_3B7BB076E19D9AD2 (service), INDEX IDX_3B7BB0768D93D649 (user), INDEX IDX_3B7BB0764FBF094F (company), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE services (id INT AUTO_INCREMENT NOT NULL, company INT DEFAULT NULL, categorie INT DEFAULT NULL, type VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, field VARCHAR(255) NOT NULL, INDEX IDX_7332E1694FBF094F (company), INDEX IDX_7332E169497DD634 (categorie), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subcategory (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_subcategory (subcategory_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_A1F33A575DC6FE57 (subcategory_id), INDEX IDX_A1F33A574584665A (product_id), PRIMARY KEY(subcategory_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sucess_story (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, lien VARCHAR(300) DEFAULT NULL, date DATE DEFAULT NULL, photo VARCHAR(5000) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarifads (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, price VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarifadsuser (id INT AUTO_INCREMENT NOT NULL, tarif INT DEFAULT NULL, user INT DEFAULT NULL, adv INT DEFAULT NULL, paid TINYINT(1) NOT NULL, price INT NOT NULL, INDEX IDX_753A672DE7189C9 (tarif), INDEX IDX_753A672D8D93D649 (user), INDEX IDX_753A672DEA302AF (adv), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(4096) NOT NULL, role VARCHAR(50) NOT NULL, token VARCHAR(255) NOT NULL, emailValidated TINYINT(1) NOT NULL, actived TINYINT(1) NOT NULL, inscription_date DATE DEFAULT NULL, connected TINYINT(1) DEFAULT NULL, dtype VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fav_company (user_id INT NOT NULL, company_id INT NOT NULL, INDEX IDX_30AF0FDDA76ED395 (user_id), INDEX IDX_30AF0FDD979B1AD6 (company_id), PRIMARY KEY(user_id, company_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visite (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, company_slug VARCHAR(255) NOT NULL, number INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Participation ADD CONSTRAINT FK_182BA9BAEE06EE26 FOREIGN KEY (idcovoiturage) REFERENCES communauty (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Participation ADD CONSTRAINT FK_182BA9BA115E1BBE FOREIGN KEY (idparticipant) REFERENCES user (id)');
        $this->addSql('ALTER TABLE Userorder ADD CONSTRAINT FK_507C2DE9BC06EA63 FOREIGN KEY (creator) REFERENCES user (id)');
        $this->addSql('ALTER TABLE activitiesdisplay ADD CONSTRAINT FK_EAFB9F6DCF60E67C FOREIGN KEY (owner) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ads ADD CONSTRAINT FK_7EC9F620BC06EA63 FOREIGN KEY (creator) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ads ADD CONSTRAINT FK_7EC9F62064D218E FOREIGN KEY (location_id) REFERENCES locations (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7D34A04AD FOREIGN KEY (product) REFERENCES product (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7BC06EA63 FOREIGN KEY (creator) REFERENCES user (id)');
        $this->addSql('ALTER TABLE category_subcategory ADD CONSTRAINT FK_BA47E62312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_subcategory ADD CONSTRAINT FK_BA47E6235DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategory (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentReport ADD CONSTRAINT FK_E02106DFF8697D13 FOREIGN KEY (comment_id) REFERENCES postcomment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentReport ADD CONSTRAINT FK_E02106DFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE communauty ADD CONSTRAINT FK_35C81BD6FAD8DA84 FOREIGN KEY (createur) REFERENCES user (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_category ADD CONSTRAINT FK_1EDB0CAC979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_category ADD CONSTRAINT FK_1EDB0CAC12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_fav ADD CONSTRAINT FK_72686407A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE company_fav ADD CONSTRAINT FK_72686407979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE depense ADD CONSTRAINT FK_34059757FAD8DA84 FOREIGN KEY (createur) REFERENCES user (id)');
        $this->addSql('ALTER TABLE discussion ADD CONSTRAINT FK_C0B9F90F6804FB49 FOREIGN KEY (recipient) REFERENCES user (id)');
        $this->addSql('ALTER TABLE discussion ADD CONSTRAINT FK_C0B9F90F5F004ACF FOREIGN KEY (sender) REFERENCES user (id)');
        $this->addSql('ALTER TABLE discussionquote ADD CONSTRAINT FK_133A17D9E19D9AD2 FOREIGN KEY (service) REFERENCES serviceofferuser (id)');
        $this->addSql('ALTER TABLE discussionquote ADD CONSTRAINT FK_133A17D95F004ACF FOREIGN KEY (sender) REFERENCES user (id)');
        $this->addSql('ALTER TABLE discussionquote ADD CONSTRAINT FK_133A17D96804FB49 FOREIGN KEY (recipient) REFERENCES user (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE event_fav ADD CONSTRAINT FK_675425BCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE event_fav ADD CONSTRAINT FK_675425BC71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE favoritecompany ADD CONSTRAINT FK_8A3982365F0662BD FOREIGN KEY (idCompany) REFERENCES company (id)');
        $this->addSql('ALTER TABLE favoritecompany ADD CONSTRAINT FK_8A398236FE6E88D7 FOREIGN KEY (idUser) REFERENCES user (id)');
        $this->addSql('ALTER TABLE favoriteproduct ADD CONSTRAINT FK_16CC8FD4C3F36F5F FOREIGN KEY (idProduct) REFERENCES product (id)');
        $this->addSql('ALTER TABLE favoriteproduct ADD CONSTRAINT FK_16CC8FD4FE6E88D7 FOREIGN KEY (idUser) REFERENCES user (id)');
        $this->addSql('ALTER TABLE friendship ADD CONSTRAINT FK_7234A45F8D93D649 FOREIGN KEY (user) REFERENCES user (id)');
        $this->addSql('ALTER TABLE friendship ADD CONSTRAINT FK_7234A45F55EEAC61 FOREIGN KEY (friend) REFERENCES user (id)');
        $this->addSql('ALTER TABLE marchandise ADD CONSTRAINT FK_D9A871DEBF396750 FOREIGN KEY (id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CACF60E67C FOREIGN KEY (owner) REFERENCES user (id)');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D64C19C1 FOREIGN KEY (category) REFERENCES postcategory (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DBC06EA63 FOREIGN KEY (creator) REFERENCES user (id)');
        $this->addSql('ALTER TABLE postcomment ADD CONSTRAINT FK_5D65518ABC06EA63 FOREIGN KEY (creator) REFERENCES user (id)');
        $this->addSql('ALTER TABLE postcomment ADD CONSTRAINT FK_5D65518A5A8A6C8D FOREIGN KEY (post) REFERENCES post (id)');
        $this->addSql('ALTER TABLE postlike ADD CONSTRAINT FK_B84FD43ABC06EA63 FOREIGN KEY (creator) REFERENCES user (id)');
        $this->addSql('ALTER TABLE postlike ADD CONSTRAINT FK_B84FD43A5A8A6C8D FOREIGN KEY (post) REFERENCES post (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADCF60E67C FOREIGN KEY (owner) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD4FBF094F FOREIGN KEY (company) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product_fav ADD CONSTRAINT FK_96B4B470A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product_fav ADD CONSTRAINT FK_96B4B4704584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE productcomment ADD CONSTRAINT FK_F3BF44BBC06EA63 FOREIGN KEY (creator) REFERENCES user (id)');
        $this->addSql('ALTER TABLE productcomment ADD CONSTRAINT FK_F3BF44BD34A04AD FOREIGN KEY (product) REFERENCES product (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784CF60E67C FOREIGN KEY (owner) REFERENCES user (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784BC06EA63 FOREIGN KEY (creator) REFERENCES user (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6CF60E67C FOREIGN KEY (owner) REFERENCES user (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6BC06EA63 FOREIGN KEY (creator) REFERENCES user (id)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2BF396750 FOREIGN KEY (id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serviceoffercategories ADD CONSTRAINT FK_BB59A884FBF094F FOREIGN KEY (company) REFERENCES user (id)');
        $this->addSql('ALTER TABLE serviceofferuser ADD CONSTRAINT FK_3B7BB076E19D9AD2 FOREIGN KEY (service) REFERENCES services (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serviceofferuser ADD CONSTRAINT FK_3B7BB0768D93D649 FOREIGN KEY (user) REFERENCES user (id)');
        $this->addSql('ALTER TABLE serviceofferuser ADD CONSTRAINT FK_3B7BB0764FBF094F FOREIGN KEY (company) REFERENCES user (id)');
        $this->addSql('ALTER TABLE services ADD CONSTRAINT FK_7332E1694FBF094F FOREIGN KEY (company) REFERENCES user (id)');
        $this->addSql('ALTER TABLE services ADD CONSTRAINT FK_7332E169497DD634 FOREIGN KEY (categorie) REFERENCES serviceoffercategories (id)');
        $this->addSql('ALTER TABLE product_subcategory ADD CONSTRAINT FK_A1F33A575DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategory (id)');
        $this->addSql('ALTER TABLE product_subcategory ADD CONSTRAINT FK_A1F33A574584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE tarifadsuser ADD CONSTRAINT FK_753A672DE7189C9 FOREIGN KEY (tarif) REFERENCES tarifads (id)');
        $this->addSql('ALTER TABLE tarifadsuser ADD CONSTRAINT FK_753A672D8D93D649 FOREIGN KEY (user) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tarifadsuser ADD CONSTRAINT FK_753A672DEA302AF FOREIGN KEY (adv) REFERENCES ads (id)');
        $this->addSql('ALTER TABLE fav_company ADD CONSTRAINT FK_30AF0FDDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fav_company ADD CONSTRAINT FK_30AF0FDD979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarifadsuser DROP FOREIGN KEY FK_753A672DEA302AF');
        $this->addSql('ALTER TABLE category_subcategory DROP FOREIGN KEY FK_BA47E62312469DE2');
        $this->addSql('ALTER TABLE company_category DROP FOREIGN KEY FK_1EDB0CAC12469DE2');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE Participation DROP FOREIGN KEY FK_182BA9BAEE06EE26');
        $this->addSql('ALTER TABLE company_category DROP FOREIGN KEY FK_1EDB0CAC979B1AD6');
        $this->addSql('ALTER TABLE company_fav DROP FOREIGN KEY FK_72686407979B1AD6');
        $this->addSql('ALTER TABLE favoritecompany DROP FOREIGN KEY FK_8A3982365F0662BD');
        $this->addSql('ALTER TABLE fav_company DROP FOREIGN KEY FK_30AF0FDD979B1AD6');
        $this->addSql('ALTER TABLE event_fav DROP FOREIGN KEY FK_675425BC71F7E88B');
        $this->addSql('ALTER TABLE ads DROP FOREIGN KEY FK_7EC9F62064D218E');
        $this->addSql('ALTER TABLE postcomment DROP FOREIGN KEY FK_5D65518A5A8A6C8D');
        $this->addSql('ALTER TABLE postlike DROP FOREIGN KEY FK_B84FD43A5A8A6C8D');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D64C19C1');
        $this->addSql('ALTER TABLE commentReport DROP FOREIGN KEY FK_E02106DFF8697D13');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7D34A04AD');
        $this->addSql('ALTER TABLE favoriteproduct DROP FOREIGN KEY FK_16CC8FD4C3F36F5F');
        $this->addSql('ALTER TABLE marchandise DROP FOREIGN KEY FK_D9A871DEBF396750');
        $this->addSql('ALTER TABLE product_fav DROP FOREIGN KEY FK_96B4B4704584665A');
        $this->addSql('ALTER TABLE productcomment DROP FOREIGN KEY FK_F3BF44BD34A04AD');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2BF396750');
        $this->addSql('ALTER TABLE product_subcategory DROP FOREIGN KEY FK_A1F33A574584665A');
        $this->addSql('ALTER TABLE services DROP FOREIGN KEY FK_7332E169497DD634');
        $this->addSql('ALTER TABLE discussionquote DROP FOREIGN KEY FK_133A17D9E19D9AD2');
        $this->addSql('ALTER TABLE serviceofferuser DROP FOREIGN KEY FK_3B7BB076E19D9AD2');
        $this->addSql('ALTER TABLE category_subcategory DROP FOREIGN KEY FK_BA47E6235DC6FE57');
        $this->addSql('ALTER TABLE product_subcategory DROP FOREIGN KEY FK_A1F33A575DC6FE57');
        $this->addSql('ALTER TABLE tarifadsuser DROP FOREIGN KEY FK_753A672DE7189C9');
        $this->addSql('ALTER TABLE Participation DROP FOREIGN KEY FK_182BA9BA115E1BBE');
        $this->addSql('ALTER TABLE Userorder DROP FOREIGN KEY FK_507C2DE9BC06EA63');
        $this->addSql('ALTER TABLE activitiesdisplay DROP FOREIGN KEY FK_EAFB9F6DCF60E67C');
        $this->addSql('ALTER TABLE ads DROP FOREIGN KEY FK_7EC9F620BC06EA63');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7BC06EA63');
        $this->addSql('ALTER TABLE commentReport DROP FOREIGN KEY FK_E02106DFA76ED395');
        $this->addSql('ALTER TABLE communauty DROP FOREIGN KEY FK_35C81BD6FAD8DA84');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FBF396750');
        $this->addSql('ALTER TABLE company_fav DROP FOREIGN KEY FK_72686407A76ED395');
        $this->addSql('ALTER TABLE depense DROP FOREIGN KEY FK_34059757FAD8DA84');
        $this->addSql('ALTER TABLE discussion DROP FOREIGN KEY FK_C0B9F90F6804FB49');
        $this->addSql('ALTER TABLE discussion DROP FOREIGN KEY FK_C0B9F90F5F004ACF');
        $this->addSql('ALTER TABLE discussionquote DROP FOREIGN KEY FK_133A17D95F004ACF');
        $this->addSql('ALTER TABLE discussionquote DROP FOREIGN KEY FK_133A17D96804FB49');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7A76ED395');
        $this->addSql('ALTER TABLE event_fav DROP FOREIGN KEY FK_675425BCA76ED395');
        $this->addSql('ALTER TABLE favoritecompany DROP FOREIGN KEY FK_8A398236FE6E88D7');
        $this->addSql('ALTER TABLE favoriteproduct DROP FOREIGN KEY FK_16CC8FD4FE6E88D7');
        $this->addSql('ALTER TABLE friendship DROP FOREIGN KEY FK_7234A45F8D93D649');
        $this->addSql('ALTER TABLE friendship DROP FOREIGN KEY FK_7234A45F55EEAC61');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CACF60E67C');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176BF396750');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DBC06EA63');
        $this->addSql('ALTER TABLE postcomment DROP FOREIGN KEY FK_5D65518ABC06EA63');
        $this->addSql('ALTER TABLE postlike DROP FOREIGN KEY FK_B84FD43ABC06EA63');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADCF60E67C');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD4FBF094F');
        $this->addSql('ALTER TABLE product_fav DROP FOREIGN KEY FK_96B4B470A76ED395');
        $this->addSql('ALTER TABLE productcomment DROP FOREIGN KEY FK_F3BF44BBC06EA63');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784CF60E67C');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784BC06EA63');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6CF60E67C');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6BC06EA63');
        $this->addSql('ALTER TABLE serviceoffercategories DROP FOREIGN KEY FK_BB59A884FBF094F');
        $this->addSql('ALTER TABLE serviceofferuser DROP FOREIGN KEY FK_3B7BB0768D93D649');
        $this->addSql('ALTER TABLE serviceofferuser DROP FOREIGN KEY FK_3B7BB0764FBF094F');
        $this->addSql('ALTER TABLE services DROP FOREIGN KEY FK_7332E1694FBF094F');
        $this->addSql('ALTER TABLE tarifadsuser DROP FOREIGN KEY FK_753A672D8D93D649');
        $this->addSql('ALTER TABLE fav_company DROP FOREIGN KEY FK_30AF0FDDA76ED395');
        $this->addSql('DROP TABLE Participation');
        $this->addSql('DROP TABLE Userorder');
        $this->addSql('DROP TABLE activitiesdisplay');
        $this->addSql('DROP TABLE ads');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_subcategory');
        $this->addSql('DROP TABLE commentReport');
        $this->addSql('DROP TABLE comment_product_fav');
        $this->addSql('DROP TABLE communauty');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE company_category');
        $this->addSql('DROP TABLE company_fav');
        $this->addSql('DROP TABLE company_favoris');
        $this->addSql('DROP TABLE coup_de_projecteur');
        $this->addSql('DROP TABLE cssstyle');
        $this->addSql('DROP TABLE depense');
        $this->addSql('DROP TABLE discussion');
        $this->addSql('DROP TABLE discussionquote');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_fav');
        $this->addSql('DROP TABLE favoritecompany');
        $this->addSql('DROP TABLE favoriteproduct');
        $this->addSql('DROP TABLE forumads');
        $this->addSql('DROP TABLE friendship');
        $this->addSql('DROP TABLE invention');
        $this->addSql('DROP TABLE locations');
        $this->addSql('DROP TABLE marchandise');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE postcategory');
        $this->addSql('DROP TABLE postcomment');
        $this->addSql('DROP TABLE postlike');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE productAds');
        $this->addSql('DROP TABLE product_click');
        $this->addSql('DROP TABLE product_fav');
        $this->addSql('DROP TABLE productcomment');
        $this->addSql('DROP TABLE report');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE serviceoffercategories');
        $this->addSql('DROP TABLE serviceofferuser');
        $this->addSql('DROP TABLE services');
        $this->addSql('DROP TABLE subcategory');
        $this->addSql('DROP TABLE product_subcategory');
        $this->addSql('DROP TABLE sucess_story');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tarifads');
        $this->addSql('DROP TABLE tarifadsuser');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE fav_company');
        $this->addSql('DROP TABLE visite');
    }
}