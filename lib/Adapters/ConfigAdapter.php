<?php

namespace Novatorius\PHPNomad\DatabaseSchemas\Config\Adapters;

use Novatorius\PHPNomad\DatabaseSchemas\Config\Models\Config;
use PHPNomad\Datastore\Interfaces\DataModel;
use PHPNomad\Datastore\Interfaces\ModelAdapter;
use PHPNomad\Utils\Helpers\Arr;

class ConfigAdapter implements ModelAdapter
{
    /**
     * @param Config $model
     * @return array
     */
    public function toArray(DataModel $model): array
    {
        return [
          'type' => $model->getType(),
          'subtype' => $model->getSubtype(),
          'configKey' => $model->getKey(),
          'value' => $model->getValue()
        ];
    }

    /**
     * @param $array array {id: int,  status: string, fullName: string, nickname: string, email: string}
     * @return Config
     */
    public function toModel(array $array): DataModel
    {
        return new Config(
          Arr::get($array, 'type'),
          Arr::get($array, 'subtype'),
          Arr::get($array, 'configKey'),
          Arr::get($array, 'value'),
        );
    }
}