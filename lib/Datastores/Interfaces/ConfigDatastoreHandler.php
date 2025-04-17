<?php

namespace Novatorius\PHPNomad\DatabaseSchemas\Config\Interfaces;

use PHPNomad\Datastore\Interfaces\Datastore;
use PHPNomad\Datastore\Interfaces\DatastoreHasCounts;
use PHPNomad\Datastore\Interfaces\DatastoreHasWhere;

interface ConfigDatastoreHandler extends Datastore, DatastoreHasWhere, DatastoreHasCounts
{
}