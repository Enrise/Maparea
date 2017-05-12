<?php

namespace Enrise\Maparea;

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
     * Maps the data from a config.
     *
     * @param array $data
     * @param array $config
     *
     * @return array
     */
    public function mapData(array $data, array $config): array
    {
        $mappedData = [];

        foreach ($config as $key => $value) {

            //filters the value from the data based on the current config.
            $filteredValue = JmesPath::search($value["from"], $data);

            //checks if we have a service to call.
            if (isset($value["service"])) {

                /** @var MapperServiceInterface $service */
                $service = $value["service"];

                if(!$service instanceof MapperServiceInterface) {
                    throw new \RuntimeException("Service should be an instance of MapperServiceInterface.");
                }

                $mappedData[$key] = $service->map($filteredValue);
            } else {
                $mappedData[$key] = is_null($filteredValue) ? '' : $filteredValue;
            }
        }

        return $mappedData;
    }

}