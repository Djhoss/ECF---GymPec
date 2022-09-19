<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220816081100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE administration (id INT AUTO_INCREMENT NOT NULL, name_role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE administration_user (administration_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_1C4927A39B8E743 (administration_id), INDEX IDX_1C4927AA76ED395 (user_id), PRIMARY KEY(administration_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE administration_user ADD CONSTRAINT FK_1C4927A39B8E743 FOREIGN KEY (administration_id) REFERENCES administration (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE administration_user ADD CONSTRAINT FK_1C4927AA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE administration_user DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('DROP TABLE administration');
        $this->addSql('DROP TABLE administration_user');
    }
}
