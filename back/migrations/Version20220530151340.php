<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220530151340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE team_id_seq CASCADE');
        $this->addSql('ALTER TABLE match_game ADD team_home_id UUID DEFAULT NULL');
        $this->addSql('ALTER TABLE match_game ADD team_away_id UUID DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN match_game.team_home_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN match_game.team_away_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE match_game ADD CONSTRAINT FK_424480FED7B4B9AB FOREIGN KEY (team_home_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE match_game ADD CONSTRAINT FK_424480FE729679A8 FOREIGN KEY (team_away_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_424480FED7B4B9AB ON match_game (team_home_id)');
        $this->addSql('CREATE INDEX IDX_424480FE729679A8 ON match_game (team_away_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE team_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE match_game DROP CONSTRAINT FK_424480FED7B4B9AB');
        $this->addSql('ALTER TABLE match_game DROP CONSTRAINT FK_424480FE729679A8');
        $this->addSql('DROP INDEX IDX_424480FED7B4B9AB');
        $this->addSql('DROP INDEX IDX_424480FE729679A8');
        $this->addSql('ALTER TABLE match_game DROP team_home_id');
        $this->addSql('ALTER TABLE match_game DROP team_away_id');
    }
}
