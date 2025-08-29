<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250829002112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B3656608F3EC46');
        $this->addSql('DROP INDEX IDX_4B3656608F3EC46 ON stock');
        $this->addSql('ALTER TABLE stock CHANGE article_id_id article_id INT NOT NULL');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B3656607294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_4B3656607294869C ON stock (article_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B3656607294869C');
        $this->addSql('DROP INDEX IDX_4B3656607294869C ON stock');
        $this->addSql('ALTER TABLE stock CHANGE article_id article_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B3656608F3EC46 FOREIGN KEY (article_id_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_4B3656608F3EC46 ON stock (article_id_id)');
    }
}
