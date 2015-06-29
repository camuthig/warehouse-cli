<?php namespace WarehouseCLI\Command\Order;

use WarehouseCLI\Command\Common\BasicCreateCommand;

class OrderCreateCommand extends BasicCreateCommand {

    public function arguments($args) {

        $args->add('product')
            ->desc('The product name or id');

        $args->add('address')
            ->desc('The destination address for the order');
    }

    function execute($product, $address) {
        $jsonData = [
            'product'    => $product,
            'address'    => $address
        ];
        $this->create('orders', $jsonData);
    }
}