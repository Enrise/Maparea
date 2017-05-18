<?php

namespace Enrise\Maparea;

use Enrise\Maparea\Exception\MapperServiceNotFoundException;
use Enrise\Maparea\Loader\LoaderInterface;
use Enrise\Maparea\Service\MapperServiceInterface;
use JmesPath\Env as JmesPath;

/**
 * Class Mapper
 *
 * @package Enrise\Maparea
 */
class Mapper
{

    /**
     * @var LoaderInterface
     */
    private $loader;

    /**
     * Constructs the Mapper object with a Loader.
     *
     * @param LoaderInterface $loader
     *
     * @return Mapper
     */
    public static function withLoader(LoaderInterface $loader): self
    {
        $mapper = new self;
        $mapper->setLoader($loader);
        return $mapper;
    }

    /**
     * Maps the data from a config array.
     *
     * @param array $data
     * @param array $config
     *
     * @return array
     */
    public function mapDataFromArray(array $data, array $config): array
    {
        return $this->mapData($data, $config);
    }

    /**
     * Maps the data and loads the config file.
     *
     * @param array $data
     * @param string $configName
     *
     * @return array
     */
    public function mapDataWithLoader(array $data, string $configName): array
    {
        return $this->mapData($data, $this->loader->load($configName));
    }

    /**
     * Maps the data from a config.
     *
     * @param array $data
     * @param array $config
     * @return array
     */
    public function mapData(array $data, array $config): array
    {
        $mappedData = [];

        foreach ($config as $key => $value) {

            //filters the value from the data based on the current config.
            $filteredValue = JmesPath::search($value["from"], $data);

            if (isset($value["service_class"])) {
                $class = $value["service_class"];
                $value["service"] = $value["service_class"];

                /** @var AbstractConverterService $service */
                $service = new $class();
                if (!$service instanceof MapperServiceInterface) {
                    throw new \RuntimeException("Service should be instance of MapperServiceInterface");
                }

                $mappedData[$key] = $service->map($filteredValue);
            } else {
                $mappedData[$key] = is_null($filteredValue) ? '' : $filteredValue;
            }
        }

        return $mappedData;
    }

    /**
     * @return LoaderInterface
     */
    public function getLoader(): LoaderInterface
    {
        return $this->loader;
    }

    /**
     * @param LoaderInterface $loader
     */
    public function setLoader(LoaderInterface $loader)
    {
        $this->loader = $loader;
    }
}
