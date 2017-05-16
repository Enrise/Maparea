<?php
namespace Enrise\Maparea\Loader;

use Symfony\Component\Yaml\Yaml;

/**
 * Class YamlLoader
 *
 * @package Enrise\Maparea\Loader
 */
class YamlLoader implements LoaderInterface
{
    /**
     * Base path for the loaded files.
     *
     * @var string
     */
    private $basePath;

    /**
     * Config files that've been loaded.
     *
     * @var array
     */
    private $loadedConfigs = [];

    /**
     * YamlLoader constructor.
     *
     * @param string $basePath
     */
    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * {@inheritdoc}
     */
    public function load(string $configName): array
    {
        if (in_array($configName, $this->loadedConfigs)) {
            return $this->loadedConfigs[$configName];
        }

        $configFile = Yaml::parse(
            file_get_contents($this->basePath.'/'.$configName)
        );

        $this->loadedConfigs[$configName] = $configFile;

        return $configFile;
    }
}
