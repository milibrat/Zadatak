<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250209150154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entry (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, word VARCHAR(25) NOT NULL, wordtype VARCHAR(20) NOT NULL, definition VARCHAR(255) NOT NULL)');
        $this->addSql('DROP TABLE entries');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entries (word VARCHAR(25) NOT NULL COLLATE "NOCASE", wordtype VARCHAR(20) NOT NULL COLLATE "NOCASE", definition VARCHAR(255) NOT NULL COLLATE "NOCASE")');
        $this->addSql('DROP TABLE entry');
    }
}
