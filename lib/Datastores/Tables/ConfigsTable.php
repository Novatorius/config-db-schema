<?php
namespace Novatorius\PHPNomad\DatabaseSchemas\Config\Datastores\Tables;

use PHPNomad\Database\Abstracts\Table;
use PHPNomad\Database\Factories\Column;
use PHPNomad\Database\Factories\Index;

class ConfigsTable extends Table
{
    /** @inheritdoc */
    public function getUnprefixedName(): string
    {
        return 'configs';
    }

    /** @inheritDoc */
    public function getAlias(): string
    {
        return 'cfg';
    }

    public function getTableVersion(): string
    {
        return '1';
    }

    /** @inheritDoc */
    public function getColumns(): array
    {
        return [
          new Column('type', 'VARCHAR', [255], 'NOT NULL'),
          new Column('subtype', 'VARCHAR', [255], 'NOT NULL'),
          new Column('configKey', 'VARCHAR', [255], 'NOT NULL'),
          new Column('value', 'VARCHAR', [255]),
        ];
    }

    /** @inheritDoc */
    public function getIndices(): array
    {
        $identity = ['type', 'subtype','configKey'];
        return [
          new Index($identity, '', 'PRIMARY KEY'),
          new Index($identity, 'type_subtype_key', 'INDEX')
        ];
    }

    public function getSingularUnprefixedName(): string
    {
        return 'config';
    }
}