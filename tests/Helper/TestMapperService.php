<?php

namespace tests\Helper;

use Enrise\Maparea\Service\MapperServiceInterface;

class TestMapperService implements MapperServiceInterface
{
    public function map($value)
    {
        return $value / 1000;
    }
}
