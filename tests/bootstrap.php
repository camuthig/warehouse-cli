<?php
$loader = require __DIR__ . '/../vendor/autoload.php';
$container = \CLIFramework\ServiceContainer::getInstance();
$container['writer'] = function($c) {
    return new TestFileWriter();
};