<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230603102702 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tclasse (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, classe VARCHAR(25) NOT NULL)');
        $this->addSql('CREATE TABLE tcle (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(5) NOT NULL)');
        $this->addSql('CREATE TABLE tdepartement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, departement VARCHAR(30) NOT NULL)');
        $this->addSql('CREATE TABLE temprunt_retour (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_personnel INTEGER DEFAULT NULL, id_stock INTEGER DEFAULT NULL, date_emprunt DATE NOT NULL, heure_emprunt TIME NOT NULL, heure_retour TIME DEFAULT NULL, remarque CLOB DEFAULT NULL, CONSTRAINT FK_BDBDEDD626894FF9 FOREIGN KEY (id_personnel) REFERENCES tpersonnel (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BDBDEDD6A5B31750 FOREIGN KEY (id_stock) REFERENCES tstock (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_BDBDEDD626894FF9 ON temprunt_retour (id_personnel)');
        $this->addSql('CREATE INDEX IDX_BDBDEDD6A5B31750 ON temprunt_retour (id_stock)');
        $this->addSql('CREATE TABLE tentrer_sortie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_cle INTEGER DEFAULT NULL, id_personnel INTEGER DEFAULT NULL, date_prise DATE NOT NULL, heure_sortie TIME NOT NULL, heure_retour TIME DEFAULT NULL, CONSTRAINT FK_EC615E1FDFE4F54D FOREIGN KEY (id_cle) REFERENCES tcle (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_EC615E1F26894FF9 FOREIGN KEY (id_personnel) REFERENCES tpersonnel (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_EC615E1FDFE4F54D ON tentrer_sortie (id_cle)');
        $this->addSql('CREATE INDEX IDX_EC615E1F26894FF9 ON tentrer_sortie (id_personnel)');
        $this->addSql('CREATE TABLE tetudiant (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_sanction INTEGER DEFAULT NULL, id_classe INTEGER DEFAULT NULL, matricule INTEGER NOT NULL, nom VARCHAR(25) NOT NULL, prenom VARCHAR(25) NOT NULL, CONSTRAINT FK_5F1A7BFD3DBF7D3A FOREIGN KEY (id_sanction) REFERENCES tsanction (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5F1A7BFDA9B00A7B FOREIGN KEY (id_classe) REFERENCES tclasse (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_5F1A7BFD3DBF7D3A ON tetudiant (id_sanction)');
        $this->addSql('CREATE INDEX IDX_5F1A7BFDA9B00A7B ON tetudiant (id_classe)');
        $this->addSql('CREATE TABLE tfamille (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, famille VARCHAR(30) NOT NULL)');
        $this->addSql('CREATE TABLE tpersonnel (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_departement INTEGER DEFAULT NULL, id_sanction INTEGER DEFAULT NULL, nom VARCHAR(25) NOT NULL, prenom VARCHAR(25) NOT NULL, email CLOB DEFAULT NULL, CONSTRAINT FK_5C9DAAE4D9649694 FOREIGN KEY (id_departement) REFERENCES tdepartement (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5C9DAAE43DBF7D3A FOREIGN KEY (id_sanction) REFERENCES tsanction (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_5C9DAAE4D9649694 ON tpersonnel (id_departement)');
        $this->addSql('CREATE INDEX IDX_5C9DAAE43DBF7D3A ON tpersonnel (id_sanction)');
        $this->addSql('CREATE TABLE tsanction (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date_sanction DATE NOT NULL, heure_sanction TIME NOT NULL, duree VARCHAR(40) NOT NULL, motif CLOB NOT NULL)');
        $this->addSql('CREATE TABLE tstock (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_famille INTEGER DEFAULT NULL, id_type INTEGER DEFAULT NULL, id_unite INTEGER DEFAULT NULL, designation VARCHAR(40) NOT NULL, identification VARCHAR(60) DEFAULT NULL, quantite INTEGER NOT NULL, date_entrer DATE NOT NULL, remarque CLOB DEFAULT NULL, CONSTRAINT FK_AC654F09FAEE5B63 FOREIGN KEY (id_famille) REFERENCES tfamille (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_AC654F097FE4B2B FOREIGN KEY (id_type) REFERENCES ttype (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_AC654F09F3E18028 FOREIGN KEY (id_unite) REFERENCES tunite (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_AC654F09FAEE5B63 ON tstock (id_famille)');
        $this->addSql('CREATE INDEX IDX_AC654F097FE4B2B ON tstock (id_type)');
        $this->addSql('CREATE INDEX IDX_AC654F09F3E18028 ON tstock (id_unite)');
        $this->addSql('CREATE TABLE ttype (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(30) NOT NULL)');
        $this->addSql('CREATE TABLE tunite (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, unite VARCHAR(30) NOT NULL)');
        $this->addSql('CREATE TABLE tutilisation_consomable (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_personnel INTEGER DEFAULT NULL, id_stock INTEGER DEFAULT NULL, quantite_demander INTEGER NOT NULL, quantite_livrer INTEGER NOT NULL, date_livraison DATE NOT NULL, instruction CLOB NOT NULL, reste INTEGER DEFAULT NULL, CONSTRAINT FK_A5B7450126894FF9 FOREIGN KEY (id_personnel) REFERENCES tpersonnel (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_A5B74501A5B31750 FOREIGN KEY (id_stock) REFERENCES tstock (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_A5B7450126894FF9 ON tutilisation_consomable (id_personnel)');
        $this->addSql('CREATE INDEX IDX_A5B74501A5B31750 ON tutilisation_consomable (id_stock)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tclasse');
        $this->addSql('DROP TABLE tcle');
        $this->addSql('DROP TABLE tdepartement');
        $this->addSql('DROP TABLE temprunt_retour');
        $this->addSql('DROP TABLE tentrer_sortie');
        $this->addSql('DROP TABLE tetudiant');
        $this->addSql('DROP TABLE tfamille');
        $this->addSql('DROP TABLE tpersonnel');
        $this->addSql('DROP TABLE tsanction');
        $this->addSql('DROP TABLE tstock');
        $this->addSql('DROP TABLE ttype');
        $this->addSql('DROP TABLE tunite');
        $this->addSql('DROP TABLE tutilisation_consomable');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
