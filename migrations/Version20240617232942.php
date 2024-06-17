<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240617232942 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adsense_category (adsense_id INT NOT NULL, category_id INT NOT NULL, PRIMARY KEY(adsense_id, category_id))');
        $this->addSql('CREATE INDEX IDX_69EA84CF3E05CD87 ON adsense_category (adsense_id)');
        $this->addSql('CREATE INDEX IDX_69EA84CF12469DE2 ON adsense_category (category_id)');
        $this->addSql('ALTER TABLE adsense_category ADD CONSTRAINT FK_69EA84CF3E05CD87 FOREIGN KEY (adsense_id) REFERENCES adsenses (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE adsense_category ADD CONSTRAINT FK_69EA84CF12469DE2 FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE adsenses ADD owner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adsenses ADD CONSTRAINT FK_863679B57E3C61F9 FOREIGN KEY (owner_id) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_863679B57E3C61F9 ON adsenses (owner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE adsense_category DROP CONSTRAINT FK_69EA84CF3E05CD87');
        $this->addSql('ALTER TABLE adsense_category DROP CONSTRAINT FK_69EA84CF12469DE2');
        $this->addSql('DROP TABLE adsense_category');
        $this->addSql('ALTER TABLE adsenses DROP CONSTRAINT FK_863679B57E3C61F9');
        $this->addSql('DROP INDEX IDX_863679B57E3C61F9');
        $this->addSql('ALTER TABLE adsenses DROP owner_id');
    }
}
