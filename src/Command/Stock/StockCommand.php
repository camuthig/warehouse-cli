<?php namespace WarehouseCLI\Command\Stock;

use WarehouseCLI\Command\WarehouseCLICommand;

class StockCommand extends WarehouseCLICommand {

    function brief() {
        return "Interact with stock, getting a list of available and adding new";
    }

    function init()
    {
        parent::init();
        // register your subcommand here ..
        $this->command('list', '\WarehouseCLI\Command\Stock\StockListCommand');
        $this->command('create', '\WarehouseCLI\Command\Stock\StockCreateCommand');
    }
}