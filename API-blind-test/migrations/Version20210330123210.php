<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330123210 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participation (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, player_id INT DEFAULT NULL, player_state TINYINT(1) NOT NULL, game_state TINYINT(1) NOT NULL, current_score INT DEFAULT NULL, INDEX IDX_AB55E24FE48FD905 (game_id), INDEX IDX_AB55E24F99E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F99E6F5DF FOREIGN KEY (player_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user DROP current_score, DROP ready');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE participation');
        $this->addSql('ALTER TABLE user ADD current_score INT DEFAULT NULL, ADD ready TINYINT(1) NOT NULL');
    }
}
