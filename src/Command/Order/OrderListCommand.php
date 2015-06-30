<?php namespace WarehouseCLI\Command\Order;

use WarehouseCLI\Command\WarehouseCLICommand;

class OrderListCommand extends WarehouseCLICommand {

    function execute()
    {
        // Create a client and send the request
        $stocks = $this->sendRequest('orders');

        $columns = ['id', 'warehouse_id', 'product_id', 'status', 'address'];
        $this->printGrid($columns, $stocks);
    }
}