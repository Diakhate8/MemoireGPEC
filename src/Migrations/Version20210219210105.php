<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210219210105 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, date_naiss DATE NOT NULL, lieu_naiss VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP INDEX UNIQ_C7440455450FF010 ON client');
        $this->addSql('ALTER TABLE client DROP adresse, DROP telephone');
        $this->addSql('DROP INDEX UNIQ_8D93D649450FF010 ON user');
        $this->addSql('ALTER TABLE user ADD lieu_naiss VARCHAR(255) NOT NULL, DROP telephone');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE personne');
        $this->addSql('ALTER TABLE client ADD adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD telephone BIGINT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7440455450FF010 ON client (telephone)');
        $this->addSql('ALTER TABLE user ADD telephone BIGINT NOT NULL, DROP lieu_naiss');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649450FF010 ON user (telephone)');
    }
}
