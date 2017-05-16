<?php

use Enrise\Maparea\Mapper;
use PHPUnit\Framework\TestCase;

class MapperTest extends TestCase
{
    /**
     * @var Mapper
     */
    private $mapper;

    protected function setUp()
    {
        $this->mapper = new Mapper();
    }

    /**
     * Tests simple mapping of data.
     */
    public function testSimpleArrayMapping()
    {
        $mappedData = $this->mapper->mapData(
            $this->getRawData(),
            $this->getMappingConfig()
        );


        $this->assertSame($mappedData, $this->getDesiredOutput());
    }

    /**
     * @return array
     */
    private function getMappingConfig(): array
    {
        return [
            "id" => [
                "from" => "uuid"
            ],
            "name" => [
                "from" => "customer_name"
            ]
        ];
    }

    /**
     * @return array
     */
    private function getRawData(): array
    {
        return [
            "uuid" => 1,
            "customer_name" => "John doe"
        ];
    }

    /**
     * @return array
     */
    private function getDesiredOutput(): array
    {
        return [
            "id" => 1,
            "name" => "John doe"
        ];
    }
}
