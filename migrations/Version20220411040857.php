<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220411040857 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis_produit (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, produit_id INT NOT NULL, note INT NOT NULL, commentaire LONGTEXT DEFAULT NULL, INDEX IDX_2A67C21A76ED395 (user_id), INDEX IDX_2A67C21F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, info_complémentaire LONGTEXT DEFAULT NULL, prix DOUBLE PRECISION NOT NULL, meileure_vente TINYINT(1) NOT NULL, nouvelle_arrivage TINYINT(1) DEFAULT NULL, is_featuread TINYINT(1) DEFAULT NULL, offre_spéciale TINYINT(1) DEFAULT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_categories (produit_id INT NOT NULL, categories_id INT NOT NULL, INDEX IDX_93CB7F65F347EFB (produit_id), INDEX IDX_93CB7F65A21214B7 (categories_id), PRIMARY KEY(produit_id, categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_en_relation (id INT AUTO_INCREMENT NOT NULL, produit_id INT DEFAULT NULL, INDEX IDX_5172ED56F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags_produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags_produit_produit (tags_produit_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_7D61ADAC6D8D621A (tags_produit_id), INDEX IDX_7D61ADACF347EFB (produit_id), PRIMARY KEY(tags_produit_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis_produit ADD CONSTRAINT FK_2A67C21A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE avis_produit ADD CONSTRAINT FK_2A67C21F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit_categories ADD CONSTRAINT FK_93CB7F65F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_categories ADD CONSTRAINT FK_93CB7F65A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_en_relation ADD CONSTRAINT FK_5172ED56F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE tags_produit_produit ADD CONSTRAINT FK_7D61ADAC6D8D621A FOREIGN KEY (tags_produit_id) REFERENCES tags_produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tags_produit_produit ADD CONSTRAINT FK_7D61ADACF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit_categories DROP FOREIGN KEY FK_93CB7F65A21214B7');
        $this->addSql('ALTER TABLE avis_produit DROP FOREIGN KEY FK_2A67C21F347EFB');
        $this->addSql('ALTER TABLE produit_categories DROP FOREIGN KEY FK_93CB7F65F347EFB');
        $this->addSql('ALTER TABLE produit_en_relation DROP FOREIGN KEY FK_5172ED56F347EFB');
        $this->addSql('ALTER TABLE tags_produit_produit DROP FOREIGN KEY FK_7D61ADACF347EFB');
        $this->addSql('ALTER TABLE tags_produit_produit DROP FOREIGN KEY FK_7D61ADAC6D8D621A');
        $this->addSql('DROP TABLE avis_produit');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_categories');
        $this->addSql('DROP TABLE produit_en_relation');
        $this->addSql('DROP TABLE tags_produit');
        $this->addSql('DROP TABLE tags_produit_produit');
    }
}
