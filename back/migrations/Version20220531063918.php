<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220531063918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE team_player (team_id UUID NOT NULL, player_id UUID NOT NULL, PRIMARY KEY(team_id, player_id))');
        $this->addSql('CREATE INDEX IDX_EE023DBC296CD8AE ON team_player (team_id)');
        $this->addSql('CREATE INDEX IDX_EE023DBC99E6F5DF ON team_player (player_id)');
        $this->addSql('COMMENT ON COLUMN team_player.team_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN team_player.player_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE team_player ADD CONSTRAINT FK_EE023DBC296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE team_player ADD CONSTRAINT FK_EE023DBC99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE team_player');
    }
}
