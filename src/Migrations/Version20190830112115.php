<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190830112115 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE articolo (id VARCHAR(13) NOT NULL, classe_id INT DEFAULT NULL, descrizione VARCHAR(254) DEFAULT NULL, um VARCHAR(15) DEFAULT NULL, immagine VARCHAR(20) DEFAULT NULL, INDEX IDX_785868378F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE articolo_articolo (articolo_source VARCHAR(13) NOT NULL, articolo_target VARCHAR(13) NOT NULL, INDEX IDX_E88D133E89328262 (articolo_source), INDEX IDX_E88D133E90D7D2ED (articolo_target), PRIMARY KEY(articolo_source, articolo_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, codice VARCHAR(13) NOT NULL, descrizione VARCHAR(100) DEFAULT NULL, UNIQUE INDEX UNIQ_8F87BF96A48A0183 (codice), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE famiglia (id VARCHAR(30) NOT NULL, descrizione VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE famiglia_articolo (famiglia_id VARCHAR(30) NOT NULL, articolo_id VARCHAR(13) NOT NULL, INDEX IDX_ED5949AE30D47B88 (famiglia_id), INDEX IDX_ED5949AE8FF10E34 (articolo_id), PRIMARY KEY(famiglia_id, articolo_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE finitura (id INT AUTO_INCREMENT NOT NULL, descrizione VARCHAR(50) NOT NULL, codice VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE listino (id INT AUTO_INCREMENT NOT NULL, data_emissione DATE NOT NULL, data_scadenza DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prodotto (id INT AUTO_INCREMENT NOT NULL, listino_id INT DEFAULT NULL, finitura_id INT DEFAULT NULL, articolo_id VARCHAR(13) DEFAULT NULL, prezzo NUMERIC(9, 3) NOT NULL, INDEX IDX_8176041B11D5B5F5 (listino_id), INDEX IDX_8176041B7F51742A (finitura_id), INDEX IDX_8176041B8FF10E34 (articolo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articolo ADD CONSTRAINT FK_785868378F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE articolo_articolo ADD CONSTRAINT FK_E88D133E89328262 FOREIGN KEY (articolo_source) REFERENCES articolo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articolo_articolo ADD CONSTRAINT FK_E88D133E90D7D2ED FOREIGN KEY (articolo_target) REFERENCES articolo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE famiglia_articolo ADD CONSTRAINT FK_ED5949AE30D47B88 FOREIGN KEY (famiglia_id) REFERENCES famiglia (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE famiglia_articolo ADD CONSTRAINT FK_ED5949AE8FF10E34 FOREIGN KEY (articolo_id) REFERENCES articolo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prodotto ADD CONSTRAINT FK_8176041B11D5B5F5 FOREIGN KEY (listino_id) REFERENCES listino (id)');
        $this->addSql('ALTER TABLE prodotto ADD CONSTRAINT FK_8176041B7F51742A FOREIGN KEY (finitura_id) REFERENCES finitura (id)');
        $this->addSql('ALTER TABLE prodotto ADD CONSTRAINT FK_8176041B8FF10E34 FOREIGN KEY (articolo_id) REFERENCES articolo (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articolo_articolo DROP FOREIGN KEY FK_E88D133E89328262');
        $this->addSql('ALTER TABLE articolo_articolo DROP FOREIGN KEY FK_E88D133E90D7D2ED');
        $this->addSql('ALTER TABLE famiglia_articolo DROP FOREIGN KEY FK_ED5949AE8FF10E34');
        $this->addSql('ALTER TABLE prodotto DROP FOREIGN KEY FK_8176041B8FF10E34');
        $this->addSql('ALTER TABLE articolo DROP FOREIGN KEY FK_785868378F5EA509');
        $this->addSql('ALTER TABLE famiglia_articolo DROP FOREIGN KEY FK_ED5949AE30D47B88');
        $this->addSql('ALTER TABLE prodotto DROP FOREIGN KEY FK_8176041B7F51742A');
        $this->addSql('ALTER TABLE prodotto DROP FOREIGN KEY FK_8176041B11D5B5F5');
        $this->addSql('DROP TABLE articolo');
        $this->addSql('DROP TABLE articolo_articolo');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE famiglia');
        $this->addSql('DROP TABLE famiglia_articolo');
        $this->addSql('DROP TABLE finitura');
        $this->addSql('DROP TABLE listino');
        $this->addSql('DROP TABLE prodotto');
    }
}
