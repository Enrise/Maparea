<?php

use Enrise\Maparea\Loader\LoaderInterface;
use Enrise\Maparea\Loader\YamlLoader;
use Enrise\Maparea\Mapper;
use PHPUnit\Framework\TestCase;

/**
 * Class YamlLoaderTest
 */
class YamlLoaderTest extends TestCase
{
    /**
     * @var Mapper
     */
    private $mapper;

    /**
     * @var LoaderInterface
     */
    private $loader;

    protected function setUp()
    {
        $this->loader = new YamlLoader(__DIR__."/resources/yaml");
        $this->mapper = Mapper::withLoader($this->loader);
    }

    /**
     * Tests the mapping data with loader usage.
     */
    public function testDataMappingWithLoader()
    {
        $mappedData = $this->mapper->mapDataWithLoader(
            $this->getRawData(),
            'simple.yml'
        );

        $this->assertSame($mappedData, $this->getDesiredOutput());
    }

    /**
     * @return array
     */
    private function getRawData(): array
    {
        return [
            "uuid" => 1,
            "customer_name" => "John doe",
            "roles" => [
                "admin" => true
            ]
        ];
    }

    /**
     * @return array
     */
    private function getDesiredOutput(): array
    {
        return [
            "id" => 1,
            "name" => "John doe",
            "admin" => true
        ];
    }
}
