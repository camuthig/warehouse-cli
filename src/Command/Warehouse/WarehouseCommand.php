<?php namespace WarehouseCLI\Command\Warehouse;

use WarehouseCLI\Command\WarehouseCLICommand;

class WarehouseCommand extends WarehouseCLICommand {

    function brief() {
        return "Interact with warehouses, getting a list of available and adding new";
    }

    function init()
    {
        parent::init();
        // register your subcommand here ..
        $this->command('list', '\WarehouseCLI\Command\Warehouse\WarehouseListCommand');
        $this->command('create', '\WarehouseCLI\Command\Warehouse\WarehouseCreateCommand');
    }
}