<?php namespace WarehouseCLI\Command\Warehouse;

use WarehouseCLI\Command\WarehouseCLICommand;

class WarehouseListCommand extends WarehouseCLICommand {

    function init()
    {
        // register your subcommand here ..
    }

    function options($opts)
    {
        // command options

    }

    function execute()
    {
        $logger = $this->logger;

        //  Use curl to get the warehouse data
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, 'http://localhost:8000/api/warehouses');
        $result=curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result, true);

        $columns = ['id', 'name', 'address'];
        $this->printGrid($columns, $result);
    }
}