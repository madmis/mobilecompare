<?php

declare(strict_types=1);

namespace App\Common\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200531094204 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("
            CREATE TABLE src_brand (
                id UUID NOT NULL,
                name VARCHAR(100) NOT NULL,
                aliases JSON DEFAULT '{}' NOT NULL,
                tags JSON DEFAULT '{}' NOT NULL,
                created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
                updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
                PRIMARY KEY(id)
            );
        ");
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5CA49F4C5E237E06 ON src_brand(name);');
        $this->addSql("COMMENT ON COLUMN src_brand.id IS '(DC2Type:uuid)';");
        $this->addSql("
            CREATE TABLE src_device(
                id UUID NOT null,
                brand_id UUID default null,
                model VARCHAR(250) NOT null,
                type VARCHAR(255) NOT null,
                aliases JSON default '{}' NOT null,
                tags JSON default '{}' NOT null,
                release_date DATE default null,
                created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT null,
                updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT null,
                PRIMARY KEY(id));        
        ");
        $this->addSql('CREATE INDEX IDX_13B5949544F5D008 ON src_device(brand_id);');
        $this->addSql("COMMENT ON COLUMN src_device.id IS '(DC2Type:uuid)';");
        $this->addSql("COMMENT ON COLUMN src_device.brand_id IS '(DC2Type:uuid)';");
        $this->addSql("COMMENT ON COLUMN src_device.release_date IS '(DC2Type:date_immutable)';");
        $this->addSql("
            ALTER TABLE src_device ADD CONSTRAINT FK_13B5949544F5D008
                FOREIGN KEY(brand_id) REFERENCES src_brand(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
        ");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
