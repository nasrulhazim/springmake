<?php

namespace NasrulHazim\Console\Commands;

use NasrulHazim\Console\Commands\Command;

/**
 * Make Controller Command
 */
class MakeControllerCommand extends Command
{
    /**
     * Command Name
     * @var string
     */
    protected $name = 'controller';

    /**
     * Command Description
     * @var string
     */
    protected $description = 'Create a controller class';

    /**
     * Stub Name
     * @var string
     */
    protected $stub = 'controller';

    /**
     * Command Type
     * @var string
     */
    protected $type = 'Controllers';
}
