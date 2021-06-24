<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210624135533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE developpeur (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet_developpeur (projet_id INT NOT NULL, developpeur_id INT NOT NULL, INDEX IDX_F9CA94F9C18272 (projet_id), INDEX IDX_F9CA94F984E66085 (developpeur_id), PRIMARY KEY(projet_id, developpeur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE projet_developpeur ADD CONSTRAINT FK_F9CA94F9C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet_developpeur ADD CONSTRAINT FK_F9CA94F984E66085 FOREIGN KEY (developpeur_id) REFERENCES developpeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet ADD client_id INT NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD debut DATETIME NOT NULL, ADD description VARCHAR(255) DEFAULT NULL, ADD fin DATETIME NOT NULL, ADD budget VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA919EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_50159CA919EB6921 ON projet (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA919EB6921');
        $this->addSql('ALTER TABLE projet_developpeur DROP FOREIGN KEY FK_F9CA94F984E66085');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE developpeur');
        $this->addSql('DROP TABLE projet_developpeur');
        $this->addSql('DROP INDEX IDX_50159CA919EB6921 ON projet');
        $this->addSql('ALTER TABLE projet DROP client_id, DROP nom, DROP debut, DROP description, DROP fin, DROP budget');
    }
}
