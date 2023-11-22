<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231122114005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Score CHANGE score user_score INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD user_score_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F266EE51 FOREIGN KEY (user_score_id) REFERENCES score (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F266EE51 ON user (user_score_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE score CHANGE user_score score INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F266EE51');
        $this->addSql('DROP INDEX UNIQ_8D93D649F266EE51 ON user');
        $this->addSql('ALTER TABLE user DROP user_score_id');
    }
}
