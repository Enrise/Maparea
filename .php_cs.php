<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('vendor')
    ->exclude('var')
    ->exclude('app')
    ->exclude('public')
    ->exclude('node_modules')
    ->name('*.php')
    ->in(__DIR__);

$config = PhpCsFixer\Config::create()
    ->setRules(
        [
            '@PSR2' => true,
            'single_blank_line_before_namespace' => true,
            'concat_space' => true,
        ]
    )
    ->setFinder($finder)
    ->setCacheFile(__DIR__ . '/.php_cs.cache');

$cacheDir = getenv('TRAVIS') ? getenv('HOME') . '/.php-cs-fixer' : __DIR__;
$config->setCacheFile($cacheDir . '/.php_cs.cache');

return $config;
