<?php

namespace NasrulHazim\Console\Commands;

use NasrulHazim\Console\Commands\Command;

/**
 * Make Model Command
 */
class MakeModelCommand extends Command
{
    /**
     * Command Name
     * @var string
     */
    protected $name = 'model';

    /**
     * Command Description
     * @var string
     */
    protected $description = 'Create a model class';

    /**
     * Stub Name
     * @var string
     */
    protected $stub = 'model';
}
