<?php namespace WarehouseCLI\Command\Warehouse;

use WarehouseCLI\Command\WarehouseCLICommand;

class WarehouseCommand extends WarehouseCLICommand {

    function init()
    {
        parent::init();
        // register your subcommand here ..
        $this->command('list', '\WarehouseCLI\Command\Warehouse\WarehouseListCommand');
        $this->command('create', '\WarehouseCLI\Command\Warehouse\WarehouseCreateCommand');
    }
}