<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220530130207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE match_game ADD organized_by_id UUID DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN match_game.organized_by_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE match_game ADD CONSTRAINT FK_424480FE36217ECD FOREIGN KEY (organized_by_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_424480FE36217ECD ON match_game (organized_by_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_98197A655E237E06 ON player (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C4E0A61F5E237E06 ON team (name)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE match_game DROP CONSTRAINT FK_424480FE36217ECD');
        $this->addSql('DROP INDEX IDX_424480FE36217ECD');
        $this->addSql('ALTER TABLE match_game DROP organized_by_id');
        $this->addSql('DROP INDEX UNIQ_98197A655E237E06');
        $this->addSql('DROP INDEX UNIQ_C4E0A61F5E237E06');
    }
}
