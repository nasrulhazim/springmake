<?php

namespace NasrulHazim\Config;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class ConfigParser
{

    /**
     * @var mixed
     */
    private $value;

    /**
     * @return mixed
     */
    public function parse()
    {
        try {

            $this->value = Yaml::parse(file_get_contents($this->configFile()));

        } catch (ParseException $e) {

            printf('Unable to parse YAML string %s', $e->getMessage());
        }
    }

    protected function basePath()
    {
        return 'src/';
    }

    /**
     * @param $value
     */
    public function packageDirectory()
    {
        return $this->basePath() . $this->translate(
            $this->value['path']['basepackage'] . '/'
        );
    }

    /**
     * @return mixed
     */
    public function controllerPath()
    {
        return $this->packageDirectory() . $this->value['path']['controllers'];
    }

    /**
     * @return mixed
     */
    public function modelPath()
    {
        return $this->packageDirectory() . $this->value['path']['models'];
    }

    /**
     * @param $value
     */
    protected function translate($value)
    {
        return str_replace('.', '/', $value);
    }

    protected function configFile()
    {
        return base_path('springmake.yaml');
    }

    protected function doesConfigFileExist()
    {
        return file_exists($this->configFile()) ?: false;
    }
}
