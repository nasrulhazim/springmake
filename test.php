<?php

use NasrulHazim\Config\ConfigParser;

require __DIR__ . '/vendor/autoload.php';

$config = new ConfigParser;
$config->parse();

echo $config->controllerPath() . PHP_EOL;
echo $config->modelPath();
