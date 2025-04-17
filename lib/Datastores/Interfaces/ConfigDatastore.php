<?php

namespace Novatorius\PHPNomad\DatabaseSchemas\Config\Interfaces;

use PHPNomad\Datastore\Exceptions\DatastoreErrorException;
use PHPNomad\Datastore\Interfaces\Datastore;
use PHPNomad\Datastore\Interfaces\DatastoreHasCounts;
use PHPNomad\Datastore\Interfaces\DatastoreHasWhere;
use Novatorius\PHPNomad\DatabaseSchemas\Config\Models\Config;

interface ConfigDatastore extends Datastore, DatastoreHasWhere, DatastoreHasCounts
{
    /**
     * @template T
     * @param string $type
     * @param string $subtype
     * @param string $key
     * @param T $default
     * @return T|Config
     */
    public function getConfig(string $type, string $subtype, string $key, $default = null);

    /**
     * @param string $type
     * @param string $subtype
     * @param string $key
     * @param $default
     * @return mixed
     */
    public function getConfigValue(string $type, string $subtype, string $key, $default = null);

    /**
     * @param string $type
     * @param string $subtype
     * @param string $key
     * @param $value
     * @return void
     * @throws DatastoreErrorException
     */
    public function setConfig(string $type, string $subtype, string $key, $value): void;

    /**
     * @template T
     * @param string $type
     * @param string $subtype
     * @param string $key
     * @throws DatastoreErrorException
     * @return void
     */
    public function deleteConfig(string $type, string $subtype, string $key): void;
}