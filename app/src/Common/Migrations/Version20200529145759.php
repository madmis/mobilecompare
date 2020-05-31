<?php

declare(strict_types=1);

namespace App\Common\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200529145759 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE SEQUENCE ext_log_entries_id_seq INCREMENT BY 1 MINVALUE 1 START 1;');
        $this->addSql('CREATE SEQUENCE data_provider_id_seq INCREMENT BY 1 MINVALUE 1 START 1;');
        $this->addSql('
            CREATE TABLE ext_log_entries (
                id INT NOT NULL,
                action VARCHAR(8) NOT NULL,
                logged_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
                object_id VARCHAR(64) DEFAULT NULL,
                object_class VARCHAR(255) NOT NULL,
                version INT NOT NULL,
                data TEXT DEFAULT NULL,
                username VARCHAR(255) DEFAULT NULL,
                PRIMARY KEY(id)
            );
        ');
        $this->addSql('CREATE INDEX log_class_lookup_idx ON ext_log_entries (object_class);');
        $this->addSql('CREATE INDEX log_date_lookup_idx ON ext_log_entries (logged_at);');
        $this->addSql('CREATE INDEX log_user_lookup_idx ON ext_log_entries (username);');
        $this->addSql('CREATE INDEX log_version_lookup_idx ON ext_log_entries (object_id, object_class, version);');
        $this->addSql('COMMENT ON COLUMN ext_log_entries.data IS \'(DC2Type:array)\';');
        $this->addSql('
            CREATE TABLE data_provider (
                id INT NOT NULL,
                name VARCHAR(50) NOT NULL,
                site VARCHAR(250) NOT NULL,
                created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
                updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
                PRIMARY KEY(id)
            );
        ');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_581ABA405E237E06 ON data_provider (name);');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
