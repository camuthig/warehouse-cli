<?php namespace WarehouseCLI;

use CLIFramework\Application;

class WarehouseApplication extends Application
{
    const NAME = 'Waho';
    const VERSION = '0.1';

    /* init your application options here */
    public function options($opts)
    {
        parent::options($opts);
    }

    /* register your command here */
    public function init()
    {
        parent::init();
        $this->command('warehouse', '\WarehouseCLI\Command\Warehouse\WarehouseCommand');
        $this->command('product', '\WarehouseCLI\Command\Product\ProductCommand');
    }

}