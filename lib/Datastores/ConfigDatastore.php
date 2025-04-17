<?php

namespace Novatorius\PHPNomad\DatabaseSchemas\Config\Datastores;

use PHPNomad\Datastore\Exceptions\RecordNotFoundException;
use PHPNomad\Datastore\Exceptions\DatastoreErrorException;
use PHPNomad\Datastore\Interfaces\Datastore;
use PHPNomad\Datastore\Traits\WithDatastoreCountDecorator;
use PHPNomad\Datastore\Traits\WithDatastoreDecorator;
use PHPNomad\Datastore\Traits\WithDatastoreWhereDecorator;
use PHPNomad\Utils\Helpers\Arr;
use Novatorius\PHPNomad\DatabaseSchemas\Config\Interfaces\ConfigDatastore as ConfigDatastoreInterface;
use Novatorius\PHPNomad\DatabaseSchemas\Config\Interfaces\ConfigDatastoreHandler;
use Novatorius\PHPNomad\DatabaseSchemas\Config\Models\Config;

class ConfigDatastore implements ConfigDatastoreInterface
{
    use WithDatastoreDecorator;
    use WithDatastoreWhereDecorator;
    use WithDatastoreCountDecorator;

    protected Datastore $datastoreHandler;

    public function __construct(
      ConfigDatastoreHandler $datastoreHandler
    )
    {
        $this->datastoreHandler = $datastoreHandler;
    }

    /**
     * @inheritDoc
     */
    public function getConfig(string $type, string $subtype, string $key, $default = null)
    {
        try {
            /** @var Config[] $result */
            $result = $this->datastoreHandler->andWhere([
              ['column' => 'type', 'operator' => '=', 'value' => $type],
              ['column' => 'subtype', 'operator' => '=', 'value' => $subtype],
              ['column' => 'configKey', 'operator' => '=', 'value' => $key],
            ], 1);

            if (empty($result)) {
                return new Config($type, $subtype, $key, $default);
            }

            return Arr::first($result);
        } catch (RecordNotFoundException $e) {
            return $default;
        }
    }

    /**
     * Gets all the configurations in the specific group.
     *
     * @param string $type
     * @param string $subtype
     * @return array
     * @throws DatastoreErrorException
     */
    public function getConfigGroup(string $type, string $subtype): array
    {
        $result = $this->datastoreHandler->andWhere([
          ['column' => 'type', 'operator' => '=', 'value' => $type],
          ['column' => 'subtype', 'operator' => '=', 'value' => $subtype],
        ]);

        return $result;
    }

    /** @inheritDoc */
    public function getConfigValue(string $type, string $subtype, string $key, $default = null)
    {
        $result = $this->getConfig($type, $subtype, $key, $default);

        return $result instanceof Config ? $result->getValue() : $result;
    }

    /** @inheritDoc */
    public function setConfig(string $type, string $subtype, string $key, $value): void
    {
        try {
            $this->datastoreHandler->updateCompound(['type' => $type, 'subtype' => $subtype, 'configKey' => $key], [
              'type' => $type,
              'subtype' => $subtype,
              'configKey' => $key,
              'value' => $value
            ]);
        } catch (RecordNotFoundException $e) {
            $this->datastoreHandler->create([
              'type' => $type,
              'subtype' => $subtype,
              'configKey' => $key,
              'value' => $value
            ]);
        }
    }

    public function deleteConfig(string $type, string $subtype, string $key): void
    {
        $this->datastoreHandler->deleteWhere([
          ['column' => 'type', 'operator' => '=', 'value' => $type],
          ['column' => 'subtype', 'operator' => '=', 'value' => $subtype],
          ['column' => 'configKey', 'operator' => '=', 'value' => $key],
        ]);
    }
}