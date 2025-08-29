<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250829001911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock ADD size_id INT NOT NULL, ADD concentration_id INT NOT NULL');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660498DA827 FOREIGN KEY (size_id) REFERENCES size (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660FF5986F1 FOREIGN KEY (concentration_id) REFERENCES concentration (id)');
        $this->addSql('CREATE INDEX IDX_4B365660498DA827 ON stock (size_id)');
        $this->addSql('CREATE INDEX IDX_4B365660FF5986F1 ON stock (concentration_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660498DA827');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660FF5986F1');
        $this->addSql('DROP INDEX IDX_4B365660498DA827 ON stock');
        $this->addSql('DROP INDEX IDX_4B365660FF5986F1 ON stock');
        $this->addSql('ALTER TABLE stock DROP size_id, DROP concentration_id');
    }
}
