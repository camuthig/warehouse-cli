<?php namespace WarehouseCLI;

use CLIFramework\Application;

class WarehouseApplication extends Application
{

    /* init your application options here */
    public function options($opts)
    {
        $opts->add('v|verbose', 'Verbose logging');
    }

    /* register your command here */
    public function init()
    {
        $this->command('warehouse', '\WarehouseCLI\Command\Warehouse\WarehouseCommand');
    }

}