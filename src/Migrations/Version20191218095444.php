<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191218095444 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Script for database creation after installing all symfony dependencies';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE Persons (id int(11) NOT NULL AUTO_INCREMENT, colorEyes varchar(255) default NULL, colorCar varchar(255) default NULL, colorHouse varchar(255) default NULL, PRIMARY KEY (id))');
        $this->addSql("ALTER TABLE Persons ADD COLUMN name varchar(255) NOT NULL");
        $this->addSql("INSERT INTO Persons values (NULL,'azul claro', 'azul claro', NULL, 'Juan')");
        $this->addSql("INSERT INTO Persons values (NULL,'azulados', 'rojo', 'azul', 'Irene')");
        $this->addSql("INSERT INTO Persons values (NULL, NULL, NULL, 'naranja', 'Manuel')");
    }


    public function down(Schema $schema) : void
    {
        $this->addSql('DROP DATABASE test');
        $this->addSql('DROP TABLE person');
    }
}
