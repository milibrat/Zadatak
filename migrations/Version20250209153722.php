<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250209153722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__entry AS SELECT word, wordtype, definition FROM entry');
        $this->addSql('DROP TABLE entry');
        $this->addSql('CREATE TABLE entry (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, word VARCHAR(25) NOT NULL, wordtype VARCHAR(20) NOT NULL, definition VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO entry (word, wordtype, definition) SELECT word, wordtype, definition FROM __temp__entry');
        $this->addSql('DROP TABLE __temp__entry');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__entry AS SELECT word, wordtype, definition FROM entry');
        $this->addSql('DROP TABLE entry');
        $this->addSql('CREATE TABLE entry (word VARCHAR(25) NOT NULL, wordtype VARCHAR(20) NOT NULL, definition VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO entry (word, wordtype, definition) SELECT word, wordtype, definition FROM __temp__entry');
        $this->addSql('DROP TABLE __temp__entry');
    }
}
