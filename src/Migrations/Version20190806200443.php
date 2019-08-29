<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190806200443 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE famiglia (id VARCHAR(30) NOT NULL, descrizione VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE famiglia_articolo (famiglia_id VARCHAR(30) NOT NULL, articolo_id VARCHAR(13) NOT NULL, INDEX IDX_ED5949AE30D47B88 (famiglia_id), INDEX IDX_ED5949AE8FF10E34 (articolo_id), PRIMARY KEY(famiglia_id, articolo_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE famiglia_articolo ADD CONSTRAINT FK_ED5949AE30D47B88 FOREIGN KEY (famiglia_id) REFERENCES famiglia (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE famiglia_articolo ADD CONSTRAINT FK_ED5949AE8FF10E34 FOREIGN KEY (articolo_id) REFERENCES articolo (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE famiglia_articolo DROP FOREIGN KEY FK_ED5949AE30D47B88');
        $this->addSql('DROP TABLE famiglia');
        $this->addSql('DROP TABLE famiglia_articolo');
    }
}
