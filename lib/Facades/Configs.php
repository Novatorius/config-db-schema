<?php

namespace Novatorius\PHPNomad\DatabaseScemas\Config\Facades;

use PHPNomad\Database\Traits\WithModelAdapterFacadeMethods;
use PHPNomad\Datastore\Exceptions\DatastoreErrorException;
use PHPNomad\Datastore\Traits\WithDatastoreFacadeMethods;
use PHPNomad\Facade\Abstracts\Facade;
use PHPNomad\Singleton\Traits\WithInstance;
use Novatorius\PHPNomad\DatabaseScemas\Config\Interfaces\ConfigDatastore;
use Novatorius\PHPNomad\DatabaseScemas\Config\Adapters\ConfigAdapter;
use Novatorius\PHPNomad\DatabaseScemas\Config\Models\Config;

class Configs extends Facade
{
    use WithDatastoreFacadeMethods;
    use WithModelAdapterFacadeMethods;
    use WithInstance;

    /**
     * Gets a config object, falling back to the default when it is not set.
     *
     * @template T
     * @param string $type
     * @param string $subtype
     * @param string $key
     * @param T $default
     * @return T|Config
     */
    public static function getConfig(string $type, string $subtype, string $key, $default = null)
    {
        return static::instance()->getContainedInstance()->getConfig($type, $subtype, $key, $default);
    }

    /**
     * Gets all the configurations in the specific group.
     *
     * @param string $type
     * @param string $subtype
     * @return array
     * @throws DatastoreErrorException
     */
    public static function getConfigGroup(string $type, string $subtype): array
    {
        return static::instance()->getContainedInstance()->getConfigGroup($type, $subtype);
    }

    /**
     * Gets a single configuration value, falling back to the default when it is not set.
     *
     * @param string $type
     * @param string $subtype
     * @param string $key
     * @param $default
     * @return mixed
     */
    public static function getConfigValue(string $type, string $subtype, string $key, $default = null)
    {
        return static::instance()->getContainedInstance()->getConfigValue($type, $subtype, $key, $default);
    }


    /** @inheritDoc */
    protected function getModelAdapterInstance(): string
    {
        return ConfigAdapter::class;
    }

    /** @inheritDoc */
    protected function abstractInstance(): string
    {
        return ConfigDatastore::class;
    }
}