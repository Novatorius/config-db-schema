<?php

namespace Novatorius\PHPNomad\DatabaseScemas\Config\Datastores;

use Novatorius\PHPNomad\DatabaseScemas\Config\Adapters\ConfigAdapter;
use Novatorius\PHPNomad\DatabaseScemas\Config\Datastores\Tables\ConfigsTable;
use Novatorius\PHPNomad\DatabaseScemas\Config\Interfaces\ConfigDatastoreHandler;
use Novatorius\PHPNomad\DatabaseScemas\Config\Models\Config;
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