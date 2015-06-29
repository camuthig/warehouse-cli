<?php namespace WarehouseCLI\Command\Warehouse;

use WarehouseCLI\Command\Common\BasicCreateCommand;

class WarehouseCreateCommand extends BasicCreateCommand {

    public function arguments($args) {

        $args->add('name')
            ->desc('Warehouse name');

        $args->add('address')
            ->desc('Warehouse address');
    }

    function execute($name, $address) {
        $jsonData = [
            'name'    => $name,
            'address' => $address
        ];
        $this->create('warehouses', $jsonData);
    }
}