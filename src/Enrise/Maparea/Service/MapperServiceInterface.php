<?php
namespace Enrise\Maparea\Service;

/**
 * Interface MapperServiceInterface, service to modify data to its needs.
 *
 * @package Enrise\Maparea\Service
 */
interface MapperServiceInterface
{
    /**
     * Maps a value to its needs.
     *
     * @param $value
     *
     * @return mixed;
     */
    public function map($value);
}
