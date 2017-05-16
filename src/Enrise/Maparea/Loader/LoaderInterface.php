<?php
namespace Enrise\Maparea\Loader;

/**
 * Interface LoaderInterface
 *
 * @package Enrise\Maparea\Loader
 */
interface LoaderInterface
{
    /**
     * Loads the configuration.
     *
     * @param $configName
     * @return array
     */
    public function load(string $configName): array;
}
