<?php namespace WarehouseCLI\Command\Order;

use WarehouseCLI\Command\WarehouseCLICommand;

class OrderCommand extends WarehouseCLICommand {

    function brief() {
        return "Interact with orders, getting a list of available and adding new";
    }

    function init()
    {
        parent::init();
        // register your subcommand here ..
        $this->command('list', '\WarehouseCLI\Command\Order\OrderListCommand');
        $this->command('create', '\WarehouseCLI\Command\Order\OrderCreateCommand');
    }
}