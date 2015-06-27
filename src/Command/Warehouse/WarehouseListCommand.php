<?php namespace WarehouseCLI\Command\Warehouse;

use WarehouseCLI\Command\WarehouseCLICommand;

class WarehouseListCommand extends WarehouseCLICommand {

    function options($opts)
    {
        // command options

    }

    function execute()
    {
        // Create a client and send the request
        $warehouses = $this->sendRequest('warehouses');

        $columns = ['id', 'name', 'address'];
        $this->printGrid($columns, $warehouses);
    }
}