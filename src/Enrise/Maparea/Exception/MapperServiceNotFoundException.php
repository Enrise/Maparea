<?php
namespace Enrise\Maparea\Exception;

use Exception;

/**
 * Class MapperServiceNotFoundException
 *
 * @package Enrise\Maparea\Exception
 */
class MapperServiceNotFoundException extends Exception
{
    /**
     * MapperServiceNotFoundException constructor.
     *
     * @param string $slug
     */
    public function __construct($slug)
    {
        $this->message = sprintf('MapperService with slug %s has not been found.', $slug);
    }
}