<?php namespace WarehouseCLI\Command\Product;

use WarehouseCLI\Command\WarehouseCLICommand;

class ProductCommand extends WarehouseCLICommand {

    function brief() {
        return "Interact with products, getting a list of available and adding new";
    }

    function init()
    {
        parent::init();
        // register your subcommand here ..
        $this->command('list', '\WarehouseCLI\Command\Product\ProductListCommand');
        $this->command('create', '\WarehouseCLI\Command\Product\ProductCreateCommand');
    }
}