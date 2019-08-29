<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190805142258 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE articolo_articolo (articolo_source VARCHAR(13) NOT NULL, articolo_target VARCHAR(13) NOT NULL, INDEX IDX_E88D133E89328262 (articolo_source), INDEX IDX_E88D133E90D7D2ED (articolo_target), PRIMARY KEY(articolo_source, articolo_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articolo_articolo ADD CONSTRAINT FK_E88D133E89328262 FOREIGN KEY (articolo_source) REFERENCES articolo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articolo_articolo ADD CONSTRAINT FK_E88D133E90D7D2ED FOREIGN KEY (articolo_target) REFERENCES articolo (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE articolo_articolo');
    }
}
