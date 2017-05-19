# Maparea ![Travis build](https://api.travis-ci.org/Enrise/Maparea.svg?branch=master)

This is a PHP mapping helper utility. It's useful when you want to convert a certain array-structure into another structure. The definitions could be declared in a yaml-structure, so it's easy to verify the input and of the mapping.

## Definition
The definition is easiest done by using yaml. This project is using [JMESpath](http://github.com/mtdowling/jmespath.php), so you can define the mapping like this:

```yaml
# route.yml
id:
  from: uuid
distance:
  from: plan.distance
  service_class: \Enrise\DistanceMapper
```

```php
# map using route.yml
$mapper = new \Enrise\Maparea\Mapper();

$raw = [
    'uuid' => 'F2001E99-98E6-4C50-A965-C694EC44B810',
    'plan' => [
        'distance' => 1223
    ]
];

$mapper = Mapper::withLoader(new YamlLoader(__DIR__."/resources/yaml"));
$mappedData = $mapper->mapDataWithLoader($raw, "route.yaml");

// $mappedData
[
    'id' => 'F2001E99-98E6-4C50-A965-C694EC44B810',
    'distance' => 1.223
]
```

