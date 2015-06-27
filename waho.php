#!/usr/bin/env php
<?php

// include your PSR-0 autoloader to load classes here...
require_once __DIR__.'/vendor/autoload.php';
$app = new \WarehouseCLI\WarehouseApplication;
$app->run( $argv );