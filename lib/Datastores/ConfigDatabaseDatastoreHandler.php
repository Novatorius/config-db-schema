<?php

namespace Novatorius\PHPNomad\DatabaseSchemas\Config\Datastores;

use Novatorius\PHPNomad\DatabaseSchemas\Config\Adapters\ConfigAdapter;
use Novatorius\PHPNomad\DatabaseSchemas\Config\Datastores\Tables\ConfigsTable;
use Novatorius\PHPNomad\DatabaseSchemas\Config\Interfaces\ConfigDatastoreHandler;
use Novatorius\PHPNomad\DatabaseSchemas\Config\Models\Config;
use PHPNomad\Database\Providers\DatabaseServiceProvider;
use PHPNomad\Database\Services\TableSchemaService;
use PHPNomad\Database\Traits\WithDatastoreHandlerMethods;

class ConfigDatabaseDatastoreHandler implements ConfigDatastoreHandler
{
    use WithDatastoreHandlerMethods;

    public function __construct(
      DatabaseServiceProvider $serviceProvider,
      ConfigsTable $table,
      ConfigAdapter $adapter,
      TableSchemaService $tableSchemaService
    )
    {
        $this->tableSchemaService = $tableSchemaService;
        $this->model = Config::class;
        $this->table = $table;
        $this->modelAdapter = $adapter;
        $this->serviceProvider = $serviceProvider;
    }
}