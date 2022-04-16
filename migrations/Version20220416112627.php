<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220416112627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tags_produit_produit DROP FOREIGN KEY FK_7D61ADAC6D8D621A');
        $this->addSql('DROP TABLE tags_produit');
        $this->addSql('DROP TABLE tags_produit_produit');
        $this->addSql('ALTER TABLE produit ADD quantite INT NOT NULL, ADD date_creation DATETIME NOT NULL, ADD tags LONGTEXT DEFAULT NULL, ADD slug VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tags_produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tags_produit_produit (tags_produit_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_7D61ADAC6D8D621A (tags_produit_id), INDEX IDX_7D61ADACF347EFB (produit_id), PRIMARY KEY(tags_produit_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE tags_produit_produit ADD CONSTRAINT FK_7D61ADAC6D8D621A FOREIGN KEY (tags_produit_id) REFERENCES tags_produit (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tags_produit_produit ADD CONSTRAINT FK_7D61ADACF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit DROP quantite, DROP date_creation, DROP tags, DROP slug');
    }
}
