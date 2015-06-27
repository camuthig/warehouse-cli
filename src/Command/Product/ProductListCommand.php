<?php namespace WarehouseCLI\Command\Product;

use WarehouseCLI\Command\WarehouseCLICommand;

class ProductListCommand extends WarehouseCLICommand {

    function options($opts)
    {
        // command options

    }

    function execute()
    {
        // Create a client and send the request
        $products = $this->sendRequest('products');

        $columns = ['id', 'name', 'dimensions', 'weight'];
        $this->printGrid($columns, $products);
    }
}