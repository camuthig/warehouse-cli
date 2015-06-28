<?php namespace WarehouseCLI\Command\Stock;

use WarehouseCLI\Command\WarehouseCLICommand;

class StockListCommand extends WarehouseCLICommand {

    function execute()
    {
        // Create a client and send the request
        $stocks = $this->sendRequest('stock');

        $columns = ['id', 'warehouse_id', 'warehouse_name', 'product_id', 'product_name', 'count'];
        $this->printGrid($columns, $stocks);
    }
}