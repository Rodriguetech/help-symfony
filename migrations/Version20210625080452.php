<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210625080452 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE projet_developpeur');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA919EB6921');
        $this->addSql('DROP INDEX IDX_50159CA919EB6921 ON projet');
        $this->addSql('ALTER TABLE projet ADD client VARCHAR(255) NOT NULL, ADD developpeur VARCHAR(255) NOT NULL, DROP client_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE projet_developpeur (projet_id INT NOT NULL, developpeur_id INT NOT NULL, INDEX IDX_F9CA94F9C18272 (projet_id), INDEX IDX_F9CA94F984E66085 (developpeur_id), PRIMARY KEY(projet_id, developpeur_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE projet_developpeur ADD CONSTRAINT FK_F9CA94F984E66085 FOREIGN KEY (developpeur_id) REFERENCES developpeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet_developpeur ADD CONSTRAINT FK_F9CA94F9C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet ADD client_id INT NOT NULL, DROP client, DROP developpeur');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA919EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_50159CA919EB6921 ON projet (client_id)');
    }
}
