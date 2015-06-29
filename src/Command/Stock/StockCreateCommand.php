<?php namespace WarehouseCLI\Command\Stock;

use WarehouseCLI\Command\Common\BasicCreateCommand;

class StockCreateCommand extends BasicCreateCommand {

    public function arguments($args) {

        $args->add('product')
            ->desc('The product name or id');

        $args->add('warehouse')
            ->desc('The warehouse name or id');

        $args->add('count')
            ->desc('The amount of the product at the warehouse');
    }

    function execute($product, $warehouse, $count) {
        $jsonData = [
            'product'    => $product,
            'warehouse' => $warehouse,
            'count' => $count
        ];
        $this->create('stock', $jsonData);
        }
    }
}