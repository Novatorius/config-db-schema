<?php

namespace Novatorius\PHPNomad\DatabaseScemas\Config\Models;

use PHPNomad\Datastore\Interfaces\DataModel;

final class Config implements DataModel
{

    protected string $type;
    protected string $subtype;
    protected string $key;
    protected $value;

    public function __construct(
      string $type,
      string $subtype,
      string $key,
      $value
    )
    {
        $this->type = $type;
        $this->subtype = $subtype;
        $this->key = $key;
        $this->value = $value;
    }

    public
    function getIdentity(): array
    {
        return ['type' => $this->type, 'subtype' => $this->subtype, 'configKey' => $this->key];
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getSubtype(): string
    {
        return $this->subtype;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}