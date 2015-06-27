<?php namespace WarehouseCLI\Command\Warehouse;

use CLIFramework\Command;

class WarehouseCommand extends Command {

    function init()
    {
        // register your subcommand here ..
        $this->command('list', '\WarehouseCLI\Command\Warehouse\WarehouseListCommand');
    }

    function options($opts)
    {
        // command options

    }

    function execute()
    {
    }
}